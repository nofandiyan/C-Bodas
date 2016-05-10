@extends('templates.master')

@section('konten')

<script type="text/javascript">

   // function changeFunc() {
   //  // var userAs = document.getElementById("userAs");
   //  // var selectedValue = selectBox.options[selectBox.selectedIndex].value;
   //  var x = document.getElementById("massAvailable").value;
   //  document.getElementById("showValue").innerHTML = x;
   // }

// $(document).ready(function(){
//     $(".gender").change(function(){
//         $(this).find("option:selected").each(function(){
//             if($(this).attr("value")=="M"){
//                 $(".box").not(".M").hide();
//                 $(".male").show();
//             }
//             else if($(this).attr("value")=="F"){
//                 $(".box").not(".F").hide();
//                 $(".female").show();
//             }
//             else{
//                 $(".box").hide();
//             }
//         });
//     }).change();
// });

</script> 

@if (!empty(Auth::user()))
    @if(Auth::user()->userAs == 1)
                

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/produkVilla/{{$villa->id}}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='idMerchant' value="{{Auth::user()->id}}">

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Judul</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ $villa->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                <textarea class="form-control" name="desc">{{ $villa->desc }}</textarea> 

                                @if ($errors->has('desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- Villa -->
                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Alamat</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="street" placeholder="Jalan + Nomor" value="{{ $villa->street }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('village') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="village" value="Desa Cibodas" readonly="Desa Cibodas">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="city" value="Kab. Bandung" readonly="Kab. Bandung">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prov') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="prov" value="Jawa Barat" readonly="Jawa Barat">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="zipCode" maxlength="5" value="40391" readonly="40391">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dateOrdered') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Tanggal Sudah Terpesan</label>
                                
                                <div class="col-md-6">
                                    <input class="date form-control" type="text" name="dateOrdered">
                                    <script type="text/javascript">  
                                        $('.date').datepicker({
                                            startDate: "today",
                                            format: "dd/mm/yyyy",
                                            // clearBtn: true,
                                            language: "id",
                                            multidate: true,
                                            forceParse: false,
                                            todayHighlight: true,
                                        });
                                        // $('.date').datepicker('setDates', 
                                        //     [new Date(2016, 4, 26), new Date(2016, 4, 28)
                                        // ]);
                                        
                                        $('.date').datepicker('setDates', [
                                            <?php 
                                                $dateOrdered  = "$villa->dateOrdered";
                                                $splitDate = explode(",", $dateOrdered);
                                                $splitDateLength = count($splitDate);    
                                                for ($row = 0; $row < $splitDateLength; $row++) {
                                                  
                                                  $splitDayMonthYear = explode("/", $splitDate[$row]);
                                                  $rowLength = count($splitDayMonthYear);
                                                  $day      = $splitDayMonthYear[0];
                                                  $month    = $splitDayMonthYear[1]-1;
                                                  $year     = $splitDayMonthYear[2];

                                                  echo "new Date(".$year.",".$month.",".$day."), ";
                                                
                                                }
                                            ?>
                                        ]);

                                    </script>

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                    <!-- <label>{{ $villa->dateOrdered }} </label> -->

                                    

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('quota') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Kapasitas</label>

                                <div class="col-md-6">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="quota" step="5" min="0" value="{{ $villa->quota }}">

                                    @if ($errors->has('quota'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quota') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="control-label">Orang</label>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-6">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="price" step="50" min="0" value="{{ $villa->price }}">

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="control-label">Per Malam</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                    <i class="fa fa-btn fa-user"></i>Simpan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@else
    return view('/');
@endif
@endif

@stop
