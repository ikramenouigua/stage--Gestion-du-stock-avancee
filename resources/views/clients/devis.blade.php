<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
****<head>
********<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
********<title>Facture</title>
********<link rel="stylesheet" href="{{ asset ('bundles/crud/css/bootstrap.css') }}" />
********<link rel="stylesheet" href="{{ asset ('bundles/crud/css/bootstrap-responsive.css') }}" />
********<link rel="stylesheet" href="{{ asset ('bundles/crud/css/style.css') }}" />
********<link rel="stylesheet" href=" {{ asset ('bundles/crud/css/font-awesome.css') }}" />
********<link href=" {{ asset ('bundles/crud/css/facture.css') }}" rel="stylesheet" />
****</head>
****<body style="background-color:#444;">
*
****
************
********<h1>DevAndClick</h1>
********<table id="enTete">
************<tr>
****************<td colspan="1"></td>
****************<td colspan="1"><h1>Devis</h1></td>
****************<td colspan="1"></td>
************</tr>
**************@foreach($commandes as $cmd)
************<tr>
****************<td width="80">Page</td>
****************<td width="100">Date</td>
****************<td width="120">Ref</td>
************</tr>
************<tr>
****************<td class="color">[[page_nb]]</td>
****************<td class="color">{{ $cmd->total_ttc }}</td>
****************<td class="color">{{ $cmd->total_ttc }}</td>
************</tr>
********</table>
********<ul id="coordonnes">
************<li>{{ $cmd->total_ttc }}</li>
************<li>{{ $cmd->total_ttc }}</li>
************<li>{{ $cmd->total_ttc }}</li>
********</ul>
********<table id="entity">
************<tr>
****************<td width="280">DESIGNATION</td>
****************<td width="105">QUANTITE</td>
****************<td width="100">P.U - HT</td>
****************<td width="105">MONTANT HT</td>
****************<td width="105">MONTANT TTC</td>
************</tr>
****************
****************<tr>
********************<td class="color">{{ $cmd->total_ttc }}</td>
********************<td class="color">{{ $cmd->total_ttc }}</td>
********************<td class="color">{{ $cmd->total_ttc }}€</td>
********************<td class="color">{{ $cmd->total_ttc }} €</td>
********************<td class="color">{{ $cmd->total_ttc }}€</td>
****************</tr>
****************
********</table>

********<div id="footer">
*************
********</div>
*********
****</body>
</html>
*
***