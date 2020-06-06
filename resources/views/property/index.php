<h1>listagem de Produtos</h1>
<p><a href="<?=url('/imoveis/novo');?>">Cadastrar novo imóvel</a></p>

<?php

if(!empty($properties)){

    echo"<table>";

    echo "<tr>
    <td> Titulo </td>
    <td>Valor da Locação </td>
    <td>Valor da Compra </td>          
    </tr>";

    foreach($properties as $property){
        $linkReadMode=url('/imoveis/'.$property->name);
        $linkEditItem= url('/imoveis/editar/'.$property->name);
        $linkRemoveItem =url('/omoveis/remover/'.$property->name);

           echo "<tr>
          <td>{$property->title} </td>
         <td>R$". number_format($property->rental_price,2,',','.')."</td>
          <td>R$". number_format($property->sale_price,2,',','.')."</td> 
          <td><a href='{$linkReadMode}'>Ver Mais</a> | <a href='{$linkEditItem}'>Editar </a> 
          |<a href='{$linkRemoveItem}'> Remover</a> </td>         
          </tr>";

    
    }
    echo"</table>";
}
?>


