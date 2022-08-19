<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Actions\AbstractAction;

class CoutFracturationAction extends AbstractAction
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
        return route('voyager.finance-fracturations.create', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
    

    public function shouldActionDisplayOnDataType()
    {
        // dd(Auth::user());
        if(Auth::user()->name === "FIN")
        {

            return $this->dataType->slug == 'fracturations';
        }
        if(Auth::user()->name === "admin")
        {

            return $this->dataType->slug == 'fracturations';
        }
        
        
    }

      public function shouldActionDisplayOnRow($row)
   {
    // dd(Auth::user()->name);
    if( Auth::user()->name === "FIN")
    {
        return $row->valide == 'non';
    }
    if(Auth::user()->name === "admin")
    {
        return $row->valide == 'non';
    }
   }
    
}