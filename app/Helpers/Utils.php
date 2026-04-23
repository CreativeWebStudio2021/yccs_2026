<?php

use Illuminate\Support\Str;
use Carbon\Carbon;

if (!function_exists('creaSlug')) {
    function creaSlug($stringa) {
        $stringa = Str::slug($stringa);
		$stringa = str_replace("-","_",$stringa);
		return $stringa;
    }
}

if (!function_exists('convertDateFormat')) {
    /**
     * Converte una data da un formato all'altro.
     *
     * @param string $date        La data originale (es: "08/08/2025")
     * @param string $fromFormat  Il formato attuale (es: "d/m/Y")
     * @param string $toFormat    Il formato desiderato (es: "Y-m-d")
     * @return string|null        La data convertita o null se errore
     */
    function convertDateFormat(string $date, string $fromFormat, string $toFormat): ?string
    {
        try {
            return Carbon::createFromFormat($fromFormat, $date)->format($toFormat);
        } catch (\Exception $e) {
            return null;
        }
    }
}


if (!function_exists('smartAsset')) {
    /**
     * Restituisce l'asset locale se esiste, altrimenti l'URL remoto.
     *
     * @param string $path Il percorso relativo (es. 'web/images/foto.png')
     * @param string $fallbackHost Il dominio di fallback
     * @return string
     */
    function smartAsset($path, $fallbackHost = 'https://www.yccs.it')
    {
        // Rimuoviamo eventuali slash iniziali per coerenza
        $cleanPath = ltrim($path, '/');
        
        // Verifichiamo se il file esiste fisicamente nella cartella public
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // Se non esiste, costruiamo l'URL verso il sito originale
        return rtrim($fallbackHost, '/') . '/' . $cleanPath;
    }
}

function smartAssetNews($path, $fallbackHost = 'https://www.yccs.it')
{
    if (empty($path)) return '';

    // Se è già un URL assoluto, restituiscilo
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }

    // AGGIUNGI IL PREFISSO DELLA CARTELLA NEWS (regola questo path se diverso)
    $subfolder = "resarea/img_up/";
    $cleanPath = $subfolder . ltrim($path, '/');
    
    // Verifica locale: /var/www/.../public/resarea/img_up/Buone_feste.jpg
    if (file_exists(public_path($cleanPath))) {
        return asset($cleanPath);
    }

    // Fallback locale aggiuntivo per immagini press regate
    $pressFolder = "resarea/img_up/regate/press/";
    $pressPath = $pressFolder . basename(ltrim($path, '/'));
    if (file_exists(public_path($pressPath))) {
        return asset($pressPath);
    }

    // Fallback locale aggiuntivo per immagini in img_up/images
    $imagesFolder = "resarea/img_up/images/";
    $imagesPath = $imagesFolder . basename(ltrim($path, '/'));
    if (file_exists(public_path($imagesPath))) {
        return asset($imagesPath);
    }

    // Fallback: https://www.yccs.it/resarea/img_up/Buone_feste.jpg
    return rtrim($fallbackHost, '/') . '/' . $cleanPath;
}
