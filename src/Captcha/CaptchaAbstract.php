<?php

namespace BinshopsBlog\Captcha;

use BinshopsBlog\Interfaces\CaptchaInterface;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;
use Illuminate\Http\Request;

abstract class CaptchaAbstract implements CaptchaInterface
{
    /**
     * executed when viewing single post
     *
     *
     * @return void
     */
    public function runCaptchaBeforeShowingPosts(Request $request, BinshopsPostTranslation $binshopsBlogPost)
    {
        // no code here to run! Maybe in your subclass you can make use of this?
        /*

        But you could put something like this -
        $some_question = ...
        $correct_captcha = ...
        \View::share("correct_captcha",$some_question); // << reference this in the view file.
        \Session::put("correct_captcha",$correct_captcha);


        then in the validation rules you can check if the submitted value matched the above value. You will have to implement this.

        */
    }

    /**
     * executed when posting new comment
     *
     *
     * @return void
     */
    public function runCaptchaBeforeAddingComment(Request $request, BinshopsPost $binshopsBlogPost)
    {
        // no code here to run! Maybe in your subclass you can make use of this?
    }
}
