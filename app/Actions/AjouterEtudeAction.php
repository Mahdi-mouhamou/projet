<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Actions\AbstractAction;

class AjouterEtudeAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Créer Etude';
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
        return route('voyager.etude-avancements.create', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
    

    public function shouldActionDisplayOnDataType()
    {
        // dd(Auth::user());
        if(Auth::user()->name === "DES")
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
    if( Auth::user()->name === "DES")
    {
        return $row->valide == 'oui'&& $row->valideE == 'non';
    }
    if(Auth::user()->name === "admin")
    {
        return $row->valide == 'oui'&& $row->valideE == 'non';
    }
   }
    
}