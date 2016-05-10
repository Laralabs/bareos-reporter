<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Templates Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'template_code'
    ];

    /**
     * Find template record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $templates = Templates::where('id', $id)->get();

        foreach($templates as $template)
        {
            return $template;
        }
    }

    /**
     * Return 50 character long shorthand string
     *
     * @param $id
     * @return string
     */
    public static function getShorthandCode($id)
    {
        $template = Templates::find($id);

        if($template != null)
        {
            $string = substr($template->template_code, 0, 47);

            $string = $string.'...';

            return $string;
        }
        else
        {
            return 'Invalid template';
        }
    }

    /**
     * Return template name for given id
     *
     * @param $id
     * @return mixed
     */
    public static function getTemplateName($id)
    {
        $template = Templates::find($id);

        return $template->name;
    }
}
