<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Actions\AbstractAction;

class CoutGgAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Evaluer ';
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
        return route('voyager.finance-ggs.create', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
    

    public function shouldActionDisplayOnDataType()
    {
        // dd(Auth::user());
        if(Auth::user()->name === "FIN")
        {

            return $this->dataType->slug == 'realisation-ggs';
        }
        if(Auth::user()->name === "admin")
        {

            return $this->dataType->slug == 'realisation-ggs';
        }
        
        
    }

      public function shouldActionDisplayOnRow($row)
   {
    // dd(Auth::user()->name);
    if( Auth::user()->name === "FIN")
    {
        return $row->Valide == 'non';
    }
    if(Auth::user()->name === "admin")
    {
        return $row->Valide == 'non';
    }
   }
    
}