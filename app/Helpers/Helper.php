<?php

namespace App\Helpers;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Helper
{
    public static function successAlert($message)
    {
        $string = '';
        if (is_array($message)) {
            $string = '<ul>';
            foreach ($message as $key => $value) {
                $string .= '<li>' . ucfirst($value) . '</li>';
            }
            $string .= '</li>';
        } else {
            $string = ucfirst($message);
        }
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> 
                    ' . $string . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }

    public static function parsingAlert($message)
    {
        $string = '';
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $string .= ucfirst($value) . '<br>';
            }
        } else {
            $string = ucfirst($message);
        }
        return $string;
    }

    public static function warningAlert($message)
    {
        $string = '';
        if (is_array($message)) {

            foreach ($message as $key => $value) {
                $string .= '<li>' . ucfirst($value) . '</li>';
            }
            $string .= '</li>';
        } else {
            $string = ucfirst($message);
        }
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> <br>' . $string . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }

    public static function errorAlert($message)
    {
        $string = '';
        if (is_array($message)) {
            $string = '<ul>';
            foreach ($message as $key => $value) {
                $string .= '<li>' . ucfirst($value) . '</li>';
            }
            $string .= '</li>';
        } else {
            $string = ucfirst($message);
        }
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> ' . $string . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }

    public static function shortText($phrase, $max_words)
    {
        $phrase_array = explode(' ', $phrase);
        if (count($phrase_array) > $max_words && $max_words > 0)
            $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '...';
        return $phrase;
    }

    public static function isSuperAdmin()
    {
        return Auth::user()->roles->where('id', 1)->first();
    }


    public static function cleanSpecialChar($string)
    {
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
        return strtolower(trim($string, ' '));
    }

    /**HTTP REQUEST / PENGGANTI GUZZLE */
    public static function urlApi($config)
    {
        $url = env('API_URL') . $config['url'];
        $request = Http::withHeaders([
            env('API_KEY') => env('API_VALUE')
        ]);
        if (!empty($config['post'])) {
            return $request->post($url, $config['post']);
        } else {
            return $request->get($url);
        }
    }

    /**summernote */
    public static function inputSummernote($value = ' ')
    {
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml($value, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if (!empty($images)) {
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/summernote/images/" . Carbon::parse(NOW())->format('d-m-Y-His') . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $value = $dom->saveHTML();
        return $value;
    }

    /** digunakan untuk bantuan save, biar tidak declare" terus di repositori */
    public static function saveEloquent($eloquent, $data){
        foreach ($data as $key => $value) {
            $eloquent->$key = $value ?? null;
        }
        return $eloquent->save();
    }
}
