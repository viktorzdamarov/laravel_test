@extends('layout')
@section('generated_url')
    <?php if ($status) {
        echo 'Короткая ссылка <a href="' . $source_url . '">' . $denst_url . '</a>';
    } else {
        echo $message;
    } ?>
@endsection
