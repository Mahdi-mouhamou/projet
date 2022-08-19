<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Actions\AbstractAction;

class AjouterContratAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Créer contrat';
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
        return route('voyager.contrats.create', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
    

    public function shouldActionDisplayOnDataType()
    {
        // dd(Auth::user());
        if(Auth::user()->name === "PLF")
        {

            return $this->dataType->slug == 'perimetres';
        }
        if(Auth::user()->name === "admin")
        {

            return $this->dataType->slug == 'perimetres';
        }
        
        
    }

      public function shouldActionDisplayOnRow($row)
   {
    // dd(Auth::user()->name);
    if( Auth::user()->name === "PLF")
    {
        return $row->valide == 'oui'&& $row->valideC == 'non';
    }
    if(Auth::user()->name === "admin")
    {
        return $row->valide == 'oui'&& $row->valideC == 'non';
    }
   }
    
}