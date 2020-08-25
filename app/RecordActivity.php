<?php 
namespace App;
trait RecordActivity {
    public $oldAttributes = [];
    
    public static function bootRecordActivity(){
        static::updating(function($model){
            $model->oldAttributes = $model->getOriginal();
        });
        
        foreach(self::recorderableEvents() as $event){
            static::$event(function($model) use($event){
                $description = $event;
                $model->recordActivity("{$description}_".strtolower(class_basename($model)));
            });
        }
    }

    public static function  recorderableEvents(){
           return  isset(static::$recorderableEvents) ?  static::$recorderableEvents :  ['created','updated'];
    }

    public function recordActivity($description){
        $this->activity()->create([
            'description'   => $description,
            'changes'       => $this->updatedChanges(),
            'project_id'    => class_basename($this) == 'Project' ? $this->id : $this->project->id,
            'user_id'       => ($this->project->owner ?? $this->owner)->id,
        ]);
    }

    public function updatedChanges(){
        if($this->wasChanged()){
            return [
                'before'    =>  array_diff($this->oldAttributes,$this->getAttributes()),
                'after'     =>  $this->getChanges()
            ];
        }
    }

    public function activity(){
        return $this->morphMany('App\Activity','subject')->latest();
    }
}