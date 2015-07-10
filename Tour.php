<?php
/**
 * Created by PhpStorm.
 * User: rutger
 * Date: 7/7/2015
 * Time: 16:50
 */

namespace MyCademy\BootstrapTour;


use yii\base\Widget;
use yii\helpers\Json;

class Tour extends Widget
{
    /**
     * @var string
     */
    public $name = 'tour';

    /**
     * @var string
     */
    public $scope;

    /**
     * @var string force the start of the tour
     */
    public $forceStart = false;

    /**
     * @var array the options for the underlying Bootstrap Tour JS plugin.
     * Please refer to the corresponding [Bootstrap Toor plugin API](http://bootstraptour.com/api/) for possible options.
     */
    public $clientOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        $view = $this->getView();
        BootstrapTourPluginAsset::register($view);
        if ($this->clientOptions !== false) {

            $varName = $this->getVarName();

            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "$varName = new Tour($options);\n";
            $js .= "$varName.init();\n";
            $js .= "$varName.start({$this->forceStart});\n";
            $view->registerJs($js);
        }
    }

    public function getVarName(){
        return $this->scope ? $this->scope . '.' . $this->name : $this->name;
    }
}