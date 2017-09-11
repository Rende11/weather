<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionSimple()
    {
        $text = 'HelloTest';

        return $this->render('simple', ['text' => $text]);
    }

    public function actionSay($message = 'Hello Yii')
    {
        return $this->render('say', ['message' => $message]);
    }
}
