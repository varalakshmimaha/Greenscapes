<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_url', 'thumbnail', 'category', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The 11-character YouTube ID parsed from any YouTube URL form:
     * watch?v=, youtu.be/, /embed/, /shorts/, /live/, /v/.
     * Returns null when the URL isn't a recognisable YouTube link.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        $pattern = '~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/|v/))([A-Za-z0-9_-]{11})~i';

        return preg_match($pattern, $this->video_url, $m) ? $m[1] : null;
    }

    /**
     * Ready-to-use iframe src for the on-page player. Always uses YouTube's
     * embed host (which permits framing, unlike watch/shorts pages that send
     * X-Frame-Options and "refuse to connect"). Falls back to the raw URL.
     */
    public function getEmbedUrlAttribute(): string
    {
        $id = $this->youtube_id;

        return $id
            ? "https://www.youtube.com/embed/{$id}?autoplay=1&rel=0"
            : (string) $this->video_url;
    }

    /**
     * A reliable auto-thumbnail from the YouTube ID. Uses hqdefault.jpg, which
     * always exists (unlike maxresdefault.jpg, which 404s for Shorts and some
     * videos). Null when the URL isn't a YouTube link.
     */
    public function getYoutubeThumbnailAttribute(): ?string
    {
        $id = $this->youtube_id;

        return $id ? "https://img.youtube.com/vi/{$id}/hqdefault.jpg" : null;
    }
}
