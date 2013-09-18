<?php

class ApiController extends Controller
{
	// Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE2222';
 
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array();
    }
 
	public function actionCreate()
	{
		switch($_GET['model'])
    {
        // Get an instance of the respective model
        case 'post':
            $model = new Post;                    
            break;
        default:
            $this->_sendResponse(501, 
                sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
                $_GET['model']) );
                Yii::app()->end();
    }
    // Try to assign POST values to attributes
    foreach($_POST as $var=>$value) {
        // Does the model have this attribute? If not raise an error
        if($model->hasAttribute($var))
            $model->$var = $value;
			
        else
            $this->_sendResponse(500, 
                sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var,
                $_GET['model']) );
    }
	
    // Try to save the model
    if($model->save())
        $this->_sendResponse(200, CJSON::encode($model));
    else {
        // Errors occurred
        $msg = "<h1>Error</h1>";
        $msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
        $msg .= "<ul>";
        foreach($model->errors as $attribute=>$attr_errors) {
            $msg .= "<li>Attribute: $attribute</li>";
            $msg .= "<ul>";
            foreach($attr_errors as $attr_error)
                $msg .= "<li>$attr_error</li>";
            $msg .= "</ul>";
        }
        $msg .= "</ul>";
        $this->_sendResponse(500, $msg );
    }
	}

	public function actionDelete()
	{

	}

	public function actionList()
	{
// Get the respective model instance
    switch($_GET['model'])
    {
        case 'post':
            $models = Post::model()->findAll();
            break;
        default:
            // Model not implemented error
            $this->_sendResponse(501, sprintf(
                'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                $_GET['model']) );
            Yii::app()->end();
    }
    // Did we get some results?
    if(empty($models)) {
        // No
        $this->_sendResponse(200, 
                sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
    } else {
        // Prepare response
        $rows = array();
        foreach($models as $model)
            $rows[] = $model->attributes;
        // Send the response
        $this->_sendResponse(200, CJSON::encode($rows));
    }
	}


public function actionUpdate()
{
     // Get PUT parameters
        parse_str(file_get_contents('php://input'), $put_vars);

        switch($_GET['model'])
        {
            // Find respective model
            case 'post': // {{{ 
                $model = Post::model()->findByPk($_GET['id']);                    
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf('Error: Mode <b>update</b> is not implemented for model <b>%s</b>',$_GET['model']) );
                exit; // }}} 
        }
        if(is_null($model))
            $this->_sendResponse(400, sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",$_GET['model'], $_GET['id']) );
        
        // Try to assign PUT parameters to attributes
        foreach($put_vars as $var=>$value) {
            // Does model have this attribute?
            if($model->hasAttribute($var)) {
                $model->$var = $value;
            } else {
                // No, raise error
                $this->_sendResponse(500, sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, $_GET['model']) );
            }
        }
        // Try to save the model
        if($model->save()) {
            $this->_sendResponse(200, sprintf('The model <b>%s</b> with id <b>%s</b> has been updated.', $_GET['model'], $_GET['id']) );
        } else {
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't update model <b>%s</b>", $_GET['model']);
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error) {
                    $msg .= "<li>$attr_error</li>";
                }        
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg );
        }
}


	public function actionView()
	{

	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    // set the status
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    header($status_header);
    // and the content type
    header('Content-type: ' . $content_type);
 
    // pages with body are easy
    if($body != '')
    {
        // send the body
        echo $body;
    }
    // we need to create the body if none is passed
    else
    {
        // create some body messages
        $message = '';
 
        // this is purely optional, but makes the pages a little nicer to read
        // for your users.  Since you won't likely send a lot of different status codes,
        // this also shouldn't be too ponderous to maintain
        switch($status)
        {
            case 401:
                $message = 'You must be authorized to view this page.';
                break;
            case 404:
                $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                break;
            case 500:
                $message = 'The server encountered an error processing your request.';
                break;
            case 501:
                $message = 'The requested method is not implemented.';
                break;
        }
 
        // servers don't always have a signature turned on 
        // (this is an apache directive "ServerSignature On")
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
 
        // this should be templated in a real-world solution
        $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';
 
        echo $body;
    }
    Yii::app()->end();
}
private function _getStatusCodeMessage($status)
{
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
    );
    return (isset($codes[$status])) ? $codes[$status] : '';
}
}