@extends('templates.master')

@section('konten')

@if (!empty(Auth::user()))
    @if(Auth::user()->userAs == 1)
                

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Persewaan Villa</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/produkVilla/{{$villa->id}}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='idMerchant' value="{{Auth::user()->id}}">

                        <div class="col-md-5">
                            <div class="wrapper">
                                <div class="full-image"></div>
                                <div class="thumbnails">
                                    <label>
                                        <input type="radio" name="full-image" checked>
                                        <div class="full-image">
                                            <img src="{{ url($villa->fotoVilla1) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($villa->fotoVilla1) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($villa->fotoVilla2) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($villa->fotoVilla2) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($villa->fotoVilla3) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($villa->fotoVilla3) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($villa->fotoVilla4) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($villa->fotoVilla4) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
	                        <div class="row">
	                        	
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Judul Lapak</label>
		                            <div class="col-md-9">
		                                {{ $villa->title }}
		                            </div>
		                            <br>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Deskripsi Lapak</label>
		                            <div class="col-md-9">
		                                {{ $villa->desc }}
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Alamat</label>
		                            <div class="col-md-9">
		                                {{$villa->street}} 	<br>
		                                {{$villa->village}} 	<br>
		                                {{$villa->city}}		<br>
										{{$villa->prov}}		<br>
										{{$villa->zipCode}}	
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Tanggal Terpesan</label>
		                            <div class="col-md-9">
		                            	{{$villa->dateOrdered}}	
		                            </div>
		                            <!-- <div class="col-md-5">
		                                    <input class="date form-control" type="text" name="dateOrdered" readonly>
		                                    <script type="text/javascript">  

		                                        $('.date').datepicker({
		                                            startDate: "today",
		                                            format: "dd/mm/yyyy",
		                                            clearBtn: true,
		                                            language: "id",
		                                            multidate: true,
		                                            forceParse: false,
		                                            todayHighlight: true,
		                                            datesDisabled: ['04/06/2016', '04/21/2016']
		                                         });
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

		                                    @if ($errors->has('dateOrdered'))
		                                        <span class="help-block">
		                                            <strong>{{ $errors->first('dateOrdered') }}</strong>
		                                        </span>
		                                    @endif
		                                </div> -->
		                        </div>
		                       
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Kapasitas</label>
		                            <div class="col-md-9">
		                                {{$villa->quota}} Orang
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Biaya</label>
		                            <div class="col-md-9">
		                              	{{$villa->price}}
		                            </div>
		                        </div>

		                        <div class="col-md-12">
		                            <div class="col-md-3" align="right">
		                                <a href="/produkVilla/{{$villa->id}}/edit" class="btn btn-primary" role="button">Edit Lapak</a>
		                            </div>
		                        </div>
                        	
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

