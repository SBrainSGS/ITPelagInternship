<?php

class GlobalSettings
{
    public function getSettings(string $key, string $default = ''): array
    {
        return [$key => $default];
    }
}

class SettingsRepository extends GlobalSettings
{
    private GlobalSettings $globalSettings;

    public function __construct(GlobalSettings $globalSettings)
    {
        $this->globalSettings = $globalSettings;
    }

    public function getSettings(): array
    {
        return [
            'use-yearmonth-folders' => '2',
            'wp-uploads' => '1',
            'copy-to-s3' => '2',
            'serve-from-s3' => '3',
            'object-prefix' => '4',
            'object-versioning' => '1212',
        ];
    }

    public function getSetting(string $key, string $default = ''): string
    {
        $settings = $this->getSettings();

        if (
            isset($settings['wp-uploads']) && $settings['wp-uploads']
            && in_array($key, ['copy-to-s3', 'serve-from-s3'])
        ) {
            return $default;
        } else {
            if ('object-versioning' === $key && !isset($settings['object-versioning'])) {
                return $default;
            } else {
                if ('object-prefix' === $key && !isset($settings['object-prefix'])) {
                    return $this->get_default_object_prefix();
                } else {
                    return $this->globalSettings->getSettings($key, $default)[$key];
                }
            }
        }
    }

    private function get_default_object_prefix(): string
    {
        return 'get_default_object_prefix';
    }
}

function getOption(string $key): string
{
    $re = 'default';
    switch ($key) {
        case 'key1':
            $re = '6';
            break;
        case 'key2':
            $re = '5';
            break;
        case 'uploads_use_yearmonth_folders':
            $re = '10';
            break;
    }

    var_dump($re);
    return $re;
}
