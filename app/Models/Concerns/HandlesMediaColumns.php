<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Http\UploadedFile;

/**
 * Routes "media column" writes (thumbnails, featured_images, avatars) through
 * Spatie Media Library instead of the database, and exposes the first media
 * URL when the pseudo-column is read.
 *
 * Each consuming model declares its pseudo-columns as a plain property:
 *   protected array $mediaColumns = ['thumbnails'];
 *
 * NOTE: this trait must NOT declare $mediaColumns itself — PHP treats a
 * trait/class property pair with differing defaults as an incompatible
 * composition and raises a fatal error.
 */
trait HandlesMediaColumns
{
    /**
     * Uploaded files waiting to be stored after the model is saved.
     *
     * @var array<string, UploadedFile>
     */
    protected array $pendingMedia = [];

    public static function bootHandlesMediaColumns(): void
    {
        static::saved(function (self $model): void {
            foreach ($model->pendingMedia as $collection => $file) {
                $model->addMedia($file)->toMediaCollection($collection);
            }

            $model->pendingMedia = [];
        });
    }

    public function setAttribute($key, $value)
    {
        if ($this->isMediaColumn($key)) {
            if ($value instanceof UploadedFile) {
                $this->pendingMedia[$key] = $value;
            }

            // Never persist this key to a database column.
            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        if ($this->isMediaColumn($key)) {
            return $this->getFirstMedia($key)?->getUrl();
        }

        return parent::getAttribute($key);
    }

    protected function isMediaColumn(string $key): bool
    {
        return in_array($key, $this->mediaColumnNames(), true);
    }

    /**
     * Reads the pseudo-column list declared on the consuming model.
     *
     * @return list<string>
     */
    protected function mediaColumnNames(): array
    {
        return property_exists($this, 'mediaColumns') ? $this->mediaColumns : [];
    }
}
