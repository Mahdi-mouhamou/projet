@extends('voyager::master')

<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 70%;
      margin: auto;
    }
    h2{
        color: black;
        
    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
      color: black;
    }
    td{
        text-align: center;
    }
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      color: rgb(0, 0, 0);
      width: 50%;
    }
    </style>

@section('content')

@if ($model==='Perimetre')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    
    <tr >
        <th>Nom du Perimetre</th>
        <td>{{$hist['NomPerimetre']}}</td>
    </tr>
    <tr >
        <th>Departement</th>
        <td>{{$hist['Asset']}}</td>
    </tr>
    <tr >
        <th>Block</th>
        <td>{{$hist['Block']}}</td>
    </tr>
    <tr >
        <th>Statut</th>
        <td>{{$hist['Statut']}}</td>
    </tr>
    <tr >
        <th>Classification</th>
        <td>{{$hist['Classification']}}</td>
    </tr>
    <tr >
        <th>Superficie</th>
        <td>{{$hist['Superficie']}}</td>
    </tr>
    <tr >
        <th>Bassin</th>
        <td>{{$hist['Bassin']}}</td>
    </tr>
</tbody>
@endif
@if ($model==='POD')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    
    <tr >
        <th>Acquisition 2D</th>
        <td>{{$hist['AcusSismique2D']}}</td>
    </tr>
    <tr >
        <th>Acquisition 3D</th>
        <td>{{$hist['AcusSismique3D']}}</td>
    </tr>
    <tr >
        <th>Traitement 2D</th>
        <td>{{$hist['TraitSismique2D']}}</td>
    </tr>
    <tr >
        <th>Traitement 3D</th>
        <td>{{$hist['TraitSismique3D']}}</td>
    </tr>
    <tr >
        <th>Retraitement 2D</th>
        <td>{{$hist['RtraitSismique2D']}}</td>
    </tr>
    <tr >
        <th>Retraitement 3D</th>
        <td>{{$hist['RtraitSismique3D']}}</td>
    </tr>
    <tr >
        <th>Nombre de puit d'exploration</th>
        <td>{{$hist['NbPuitExploration']}}</td>
    </tr>
    <tr >
        <th>Nombre de puit deliniation</th>
        <td>{{$hist['NbPuitDeliniation']}}</td>
    </tr>
    <tr >
        <th>Methode potentiel</th>
        <td>{{$hist['MethodePotentiel']}}</td>
    </tr>
    <tr >
        <th>Nombre de prospect</th>
        <td>{{$hist['NbProspectG']}}</td>
    </tr>
    <tr >
        <th>Etude GG</th>
        <td>{{$hist['EtudeGG']}}</td>
    </tr>
    <tr >
        <th>phase</th>
        <td>{{$hist['phase']}}</td>
    </tr>
    <tr >
        <th>contrats</th>
        <td>{{$hist['contrat_id']}}</td>
    </tr>    
    <tr >
        <th>date debut</th>
        <td>{{$hist['dateD']}}</td>
    </tr>    
    <tr >
        <th>date fin</th>
        <td>{{$hist['dateF']}}</td>
    </tr>
</tbody>
@endif
@if ($model==='Contrat')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    
    <tr >
        <th>Statu du contrat</th>
        <td>{{$hist['statut_Contrat']}}</td>
    </tr>
    <tr >
        <th>Date de Singature du Contrat </th>
        <td>{{$hist['DateSingatureContrat']}}</td>
    </tr>
    <tr >
        <th>Date Entrer en Vigure</th>
        <td>{{$hist['DateEntrerVigure']}}</td>
    </tr>
    <tr >
        <th>engagemment 1 er phase sismique 2D</th>
        <td>{{$hist['Eng1Phase2D']}}</td>
    </tr>
    <tr >
        <th>engagemment 1 er phase sismique 3D</th>
        <td>{{$hist['Eng1Phase3D']}}</td>
    </tr>
    <tr >
        <th>engagemment 2 eme phase sismique 2D</th>
        <td>{{$hist['Eng2Phase2D']}}</td>
    </tr>
    <tr >
        <th>engagemment 2 eme phase sismique 3D</th>
        <td>{{$hist['Eng2Phase3D']}}</td>
    </tr>
    <tr >
        <th>engagemment 3 eme phase sismique 2D</th>
        <td>{{$hist['Eng3Phase2D']}}</td>
    </tr>
    <tr >
        <th>engagemment 3 eme phase sismique 3D</th>
        <td>{{$hist['Eng3Phase3D']}}</td>
    </tr>
    <tr >
        <th>periode de recherche actuel</th>
        <td>{{$hist['periodeRecherche']}}</td>
    </tr>
    <tr>
        <td>Date d'echeance du contrat</td>
        <td>{{ $hist['DateEcheance'] }}</td>
    </tr>
</tbody>
@endif
@if ($model==='Avenant')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    
    <tr >
        <th>Nom de la surface</th>
        <td>{{$hist['NomSurface']}}</td>
    </tr>
    <tr >
        <th>superficie</th>
        <td>{{$hist['superficie']}}</td>
    </tr>
    <tr >
        <th>Date Envoie</th>
        <td>{{$hist['dateEnvoie']}}</td>
    </tr>
    <tr >
        <th>date Reponse</th>
        <td>{{$hist['dateReponse']}}</td>
    </tr>
    <tr >
        <th>accord</th>
        <td>{{$hist['accord']}}</td>
    </tr>
    <tr >
        <th>motif de la Demande</th>
        <td>{{$hist['motifDemande']}}</td>
    </tr>
    <tr >
        <th>numero contrat</th>
        <td>{{$hist['contrat_id']}}</td>
    </tr>
    <tr >
        <th>Block</th>
        <td>{{$hist['Block']}}</td>
    </tr>
    
</tbody>
@endif
@if ($model==='FinanceFrac')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>coute en dinar</th>
        <td>{{$hist['CouteD']}}</td>
    </tr>
    <tr >
        <th>coute en Devise</th>
        <td>{{$hist['CouteE']}}</td>
    </tr>
    <tr >
        <th>Date de creation</th>
        <td>{{$hist['Date']}}</td>
    </tr>
    <tr >
        <th>fracturation num</th>
        <td>{{$hist['fracturation_id']}}</td>
    </tr>
    <tr >
        <th>date de validation</th>
        <td>{{$hist['dateValidation']}}</td>
    </tr>
    
    
</tbody>
@endif

@if ($model==='FinanceGg')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>coute en dinar</th>
        <td>{{$hist['CouteD']}}</td>
    </tr>
    <tr >
        <th>coute en Devise</th>
        <td>{{$hist['CouteE']}}</td>
    </tr>
    <tr >
        <th>Date de creation</th>
        <td>{{$hist['Date']}}</td>
    </tr>
    <tr >
        <th>etude gg num</th>
        <td>{{$hist['Realisation_Gg_id']}}</td>
    </tr>
    <tr >
        <th>date de validation</th>
        <td>{{$hist['dateValidation']}}</td>
    </tr>
    
    
</tbody>
@endif
    
@if ($model==='FinancePuit')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>coute en dinar</th>
        <td>{{$hist['CouteD']}}</td>
    </tr>
    <tr >
        <th>coute en Devise</th>
        <td>{{$hist['CouteE']}}</td>
    </tr>
    <tr >
        <th>Date de creation</th>
        <td>{{$hist['Date']}}</td>
    </tr>
    <tr >
        <th>puit id</th>
        <td>{{$hist['puit_id']}}</td>
    </tr>
    <tr >
        <th>date de validation</th>
        <td>{{$hist['dateValidation']}}</td>
    </tr>
    
    
</tbody>
@endif
@if ($model==='FinanceSism')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>coute en dinar</th>
        <td>{{$hist['couteD']}}</td>
    </tr>
    <tr >
        <th>coute en Devise</th>
        <td>{{$hist['couteE']}}</td>
    </tr>
    <tr >
        <th>Date de creation</th>
        <td>{{$hist['date']}}</td>
    </tr>
    <tr >
        <th>realisation sismique id</th>
        <td>{{$hist['realisation_sismique_id']}}</td>
    </tr>
    <tr >
        <th>date de validation</th>
        <td>{{$hist['dateValidation']}}</td>
    </tr>
    
    
</tbody>
@endif

@if ($model==='Sismique')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>Nom du cube</th>
        <td>{{$hist['NomCub']}}</td>
    </tr>
    <tr >
        <th>Anne de realisation</th>
        <td>{{$hist['AnneeRealisation']}}</td>
    </tr>
    <tr >
        <th>Compagnie de Service</th>
        <td>{{$hist['CompagnieServise']}}</td>
    </tr>
    <tr >
        <th>Type Sismique</th>
        <td>{{$hist['TypeSismique']}}</td>
    </tr>
    <tr >
        <th>Operation</th>
        <td>{{$hist['Operation']}}</td>
    </tr>
    <tr >
        <th>Kilometrage</th>
        <td>{{$hist['Kilometrage']}}</td>
    </tr>
    <tr >
        <th>contrat_id</th>
        <td>{{$hist['contrat_id']}}</td>
    </tr>
    <tr >
        <th>phase</th>
        <td>{{$hist['phase']}}</td>
    </tr> 
    
</tbody>
@endif
@if ($model==='Gg')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>Compangnie de Service</th>
        <td>{{$hist['CompangnieServise']}}</td>
    </tr>
    <tr >
        <th>Designation</th>
        <td>{{$hist['Designation']}}</td>
    </tr>
    <tr >
        <th>Effort Propre</th>
        <td>{{$hist['EffortPropre']}}</td>
    </tr>
    <tr >
        <th>Annee Realisation</th>
        <td>{{$hist['AnneeRealisation']}}</td>
    </tr>
    <tr >
        <th>contrat_id</th>
        <td>{{$hist['contrat_id']}}</td>
    </tr>
    <tr >
        <th>phase</th>
        <td>{{$hist['phase']}}</td>
    </tr> 
    
</tbody>
@endif

@if ($model==='Puit')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>Sigle de Puit</th>
        <td>{{$hist['SiglePuit']}}</td>
    </tr>
    <tr >
        <th>Type de Puit</th>
        <td>{{$hist['TypePuit']}}</td>
    </tr>
    <tr >
        <th>Objectif Petrolier </th>
        <td>{{$hist['ObjectifPetrolier']}}</td>
    </tr>
    <tr >
        <th>Etat du puit</th>
        <td>{{$hist['EtatPuit']}}</td>
    </tr>
    <tr >
        <th>Anne fin de sondage</th>
        <td>{{$hist['AnneeSondage']}}</td>
    </tr>
    <tr >
        <th>phase</th>
        <td>{{$hist['phase']}}</td>
    </tr> 
    <tr >
        <th>Resultat</th>
        <td>{{$hist['Resultat']}}</td>
    </tr> 
    <tr >
        <th>Reservoir id</th>
        <td>{{$hist['Reservoir_id']}}</td>
    </tr> 
</tbody>
@endif

@if ($model==='Fracturatio')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>Debit Initial</th>
        <td>{{$hist['DebitInitial']}}</td>
    </tr>
    <tr >
        <th>Debit Final</th>
        <td>{{$hist['DebitFinal']}}</td>
    </tr>
    <tr >
        <th>Effort Propre </th>
        <td>{{$hist['EffortPropre']}}</td>
    </tr>
    <tr >
        <th>puit id</th>
        <td>{{$hist['puit_id']}}</td>
    </tr>
    <tr >
        <th>Anne de realisation</th>
        <td>{{$hist['anneRelaisation']}}</td>
    </tr>
    
</tbody>
@endif

@if ($model==='Reservoir')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>Nom Reservoir</th>
        <td>{{$hist['NomReservoir']}}</td>
    </tr>
    <tr >
        <th>gisement id</th>
        <td>{{$hist['Gisement_id']}}</td>
    </tr>    
    <tr >
        <th>Nom Surface Prorogation</th>
        <td>{{$hist['NomSurfaceProrogation']}}</td>
    </tr> 
    <tr >
        <th>Superficie Prorogation</th>
        <td>{{$hist['SuperficiePro']}}</td>
    </tr>

</tbody>
@endif
@if ($model==='Gisement')
<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">Detaille historique</h2>

<table  id="customers" style="width:70%">
<tbody>
    <tr >
        <th>id</th>
        <td>{{$hist['id']}}</td>
    </tr>
    <tr >
        <th>Nom Gisement</th>
        <td>{{$hist['NomGisement']}}</td>
    </tr>
    <tr >
        <th>Perimetre id</th>
        <td>{{$hist['perimetre_id']}}</td>
    </tr>
    <tr >
        <th>Superficie </th>
        <td>{{$hist['Superficie']}}</td>
    </tr>
</tbody>
@endif

@endsection