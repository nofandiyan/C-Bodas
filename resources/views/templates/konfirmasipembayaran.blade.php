@extends('templates.master')

@section('konten')
                <section class="content eshop">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

                <br>
            <div class="panel panel-default">
            

                <div class="panel-body">
                   <form action="{{action('ConfirmationController@paymentConfirmation')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div align="center"><h2><label>Konfirmasi Pembayaran <br> </label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br/>
                 
                        <label class="col-md-4 control-label">Pilih Gambar</label>
                        
                                <input type="file" name="image" id="image" >

                            </div>
                        </div>
                            
                        <div class="col-md-12" align="center">
                            
                                <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                   </i>Upload
                                </button>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
</section>
@stop
