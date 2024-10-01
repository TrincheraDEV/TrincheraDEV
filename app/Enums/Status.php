<?php

namespace App\Enums;

enum Status: int
{
    case DRAFT = 1;
    case PUBLISHED = 2;
    case ARCHIVED = 3;

    public function isDraft(): bool
    {
        return $this === self::DRAFT;
    }

    public function isPublished(): bool
    {
        return $this === self::PUBLISHED;
    }

    public function isArchived(): bool
    {
        return $this === self::ARCHIVED;
    }

    public function getLabel(): string
    {
        return match($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::ARCHIVED => 'Archived',
        };
    }

    public function getColor(): string
    {
        return match($this) {
            self::DRAFT => 'yellow',
            self::PUBLISHED => 'green',
            self::ARCHIVED => 'zinc',
            };
        }
    }