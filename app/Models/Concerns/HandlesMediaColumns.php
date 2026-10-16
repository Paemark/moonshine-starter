<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Http\UploadedFile;

/**
 * Routes "media column" writes (thumbnails, featured_images, avatars) through
 * Spatie Media Library instead of the database, and exposes the first media
 * URL when the pseudo-column is read.
 *
 * Each consuming model MUST declare its own $mediaColumns property:
 *   protected array $mediaColumns = ['thumbnails'];
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
     * @return list<string>
     */
    protected function mediaColumnNames(): array
    {
        return $this->mediaColumns ?? [];
    }
}
