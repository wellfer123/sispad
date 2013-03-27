<?php
class JnterfaceWidget extends CWidget
{
    private $scriptFiles = null;
    private $customScriptFile = null;
    private $scriptPos;
    private $scrPos;
    private $cssFiles = null;
    private $viewData = array();
    private $viewName;

    private $baseUrl;
    private $clientScript;
    private $published = false;

    public function setScriptFiles($scriptArray, $pos = 0)
    {
        if(is_array($scriptArray))
            $this->scriptFiles = $scriptArray;
        else
            throw new CHttpException(500,'Script files need array param');
        $this->scrPos = $pos;
    }

    public function setCustomScriptFile($str, $pos = 4)
    {
        $this->customScriptFile = $str;
        $this->scriptPos = $pos;
    }
    public function setCssFiles($cssArray)
    {
        if(is_array($cssArray))
            $this->cssFiles = $cssArray;
        else
            throw new CHttpException(500,'Css files need array param');
    }

    public function setViewData($dataArray)
    {
        if(is_array($dataArray))
            $this->viewData = $dataArray;
        else
            throw new CHttpException(500,'Options need array param');
    }

    public function setViewName($vName)
    {
        $this->viewName = $vName;
    }

    public function normalizeUrl($data, $arrayField = null)
    {
        $base = Yii::app()->request->baseUrl."/";
        if(is_array($data))
        {
            if(!isset($arrayField)) throw new CHttpException(500,'Incorrect array param');
            foreach($data as $key => $row)
            {
             $str = (!stristr($row[$arrayField],'://'))? $base : "";
             $data[$key][$arrayField] = $str.$row[$arrayField];
            }
        }
        else
        {
            $str = (!stristr($data,'://'))? $base : "";
            $data = $str.$data;
        }
        return $data;
    }

    public function publishWidget($widgetID, $widgetName = null)
    {
      if(!isset($widgetName)) return;
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.$widgetName;
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
      $this->clientScript = Yii::app()->getClientScript();
      $this->clientScript->registerCoreScript('jquery');
      if(isset($this->scriptFiles))
        foreach($this->scriptFiles as $scr)
         if(!$this->clientScript->isScriptFileRegistered($this->baseUrl.'/'.$scr))
            $this->clientScript->registerScriptFile($this->baseUrl.'/'.$scr, $this->scrPos);
      if(isset($this->cssFiles))
        foreach($this->cssFiles as $css)
            $this->clientScript->registerCssFile($this->baseUrl.'/'.$css);
      if(isset($this->customScriptFile))
        //if(!$this->clientScript->isScriptRegistered($widgetName, $this->customScriptFile, $this->scriptPos))
            $this->clientScript->registerScript($widgetID, $this->customScriptFile, $this->scriptPos);
      $this->published = true;
    }

    public function forcePublished()
    {
        $this->published = true;
    }

    public function run()
    {
      if(!$this->published) throw new CHttpException(500,'Widget must be published!');
      if(isset($this->viewName))
        $this->render($this->viewName, $this->viewData);
    }
}
?>
