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
        if( Auth::user()->role_id == 6  || Auth::user()->role_id == 1)
        {
            return $this->dataType->slug == 'programmes';
        }
        
    }

      public function shouldActionDisplayOnRow($row)
   {
    if( Auth::user()->role_id == 6)
    {
        return $row->valide == 'non';
    }
    if(Auth::user()->role_id == 1)
    {
        return $row->valide == 'non';
    }
   }
    
}