<?php

namespace app\helpers;

use Yii;

class WebpHelper
{
    public static function replaceImagesWithWebp($content)
    {
        $pattern = '/(?:src|href|srcset|content|url)\s*=\s*["\']?([^"\'>]+?\.(?:jpg|jpeg|png|bmp))["\']?/i';
        
        $callback = function($matches) {
            $originalSrc = trim($matches[1]);
            
            if (strpos($originalSrc, '//') === 0) {
                $originalSrc = 'https:' . $originalSrc;
            }
            
            if (preg_match('/^(https?:|\/\/|data:)/i', $originalSrc)) {
                $parsedUrl = parse_url($originalSrc);
                if (isset($parsedUrl['host']) && $parsedUrl['host'] !== Yii::$app->request->hostName) {
                    return $matches[0];
                }
                $originalPath = $parsedUrl['path'] ?? '';
            } else {
                $originalPath = $originalSrc;
            }
            
            $pathInfo = pathinfo($originalPath);
            
            if (!isset($pathInfo['filename'])) {
                return $matches[0];
            }
            
            $webpPath = ($pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'] . '/') 
                      . $pathInfo['filename'] . '.webp';
            
            $webpFullPath = Yii::getAlias('@webroot') . $webpPath;
            
            if (file_exists($webpFullPath)) {
                if (strpos($matches[0], 'srcset') !== false) {
                    $parts = explode(',', $matches[0]);
                    $result = [];
                    foreach ($parts as $part) {
                        if (preg_match('/\s*([^"\'\s]+\.(?:jpg|jpeg|png|bmp|gif))\s*(?:\s+\d+[wx])?\s*/i', $part, $partMatches)) {
                            $partPathInfo = pathinfo($partMatches[1]);
                            $partWebpPath = ($partPathInfo['dirname'] === '.' ? '' : $partPathInfo['dirname'] . '/') 
                                          . $partPathInfo['filename'] . '.webp';
                            $partWebpFullPath = Yii::getAlias('@webroot') . $partWebpPath;
                            
                            if (file_exists($partWebpFullPath)) {
                                $result[] = str_replace($partMatches[1], $partWebpPath, $part);
                            } else {
                                $result[] = $part;
                            }
                        } else {
                            $result[] = $part;
                        }
                    }
                    return implode(',', $result);
                }
                
                return str_replace($originalSrc, $webpPath, $matches[0]);
            }
            
            return $matches[0];
        };
        
        return preg_replace_callback($pattern, $callback, $content);
    }
}