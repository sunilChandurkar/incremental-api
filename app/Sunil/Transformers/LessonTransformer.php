<?php 

namespace App\Sunil\Transformers;

class LessonTransformer extends Transformer{

    public function transform($lesson){
        
            return [
                    'title'=>$lesson['title'],
                    'body'=>$lesson['body'],
                    'isPublished'=>(boolean)$lesson['isPublished']
            ];
        
    }

}