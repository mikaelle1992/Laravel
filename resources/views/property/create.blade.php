@extends('property.master')

@section('content')
<div class="container my-3">
<h1> Formulario de Cadastro:: Imoveis</h1>

<form method="post" action="<?= url('/imoveis/store'); ?>">

    <?= csrf_field(); ?>

    <div class="form-group">
    <label for="title">Titulo do imovel</label>
    <input type="text" name="title" id="title" class="form-control">
    </div>

    <div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
    </div>

    <div class="form-group">
    <label for="rental_price">Valor da Locação</label>
    <input type="text" name="rental_price" id="rental_price" class="form-control">
    </div>

    <div class="form-group">
    <label for="sale_price">Valor da Compra</label>
    <input type="text" name="sale_price" id="sale_price" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Imóvel</button>

</form>
</div>
@endsection