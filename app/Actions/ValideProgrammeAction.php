<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Actions\AbstractAction;

class ValideProgrammeAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Valide';
    }

    public function getIcon()
    {
        return 'voyager-settings';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('Programme.valide', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
    

    public function shouldActionDisplayOnDataType()
    {

        if(Auth::user()->name === "admin")
        {
            return $this->dataType->slug == 'programmes';
        }
        if(Auth::user()->name === "ASSET")
        {
            return $this->dataType->slug == 'programmes';
        }
        
    }

      public function shouldActionDisplayOnRow($row)
   {
    if( Auth::user()->name === "ASSET")
    {
        return $row->valide == 'non';
    }
    if(Auth::user()->name === "admin")
    {
        return $row->valide == 'non';
    }
   }
    
}