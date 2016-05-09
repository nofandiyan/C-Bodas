@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">UploadImageMerchant</div>

                <div class="panel-body">
                    <div class="form-group{{ $errors->has('imageMerchant') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Unggah Foto</label>

                        <div class="col-md-6">
                                
                            <form action="{{ URL::to('uploadImageMerchant') }}" method="post" enctype="multipart/form-data">
                                    <input type="file" name="imageMerchant" id="imageMerchant">
                                    </br>
                                    <input type="submit" value="Unggah" name="submit">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            </form>

                            @if ($errors->has('imageMerchant'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('imageMerchant') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection