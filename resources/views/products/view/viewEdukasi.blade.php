@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Edukasi</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/produkEdukasi/{{$edukasi->id}}">
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
                                            <img src="{{ url($edukasi->fotoEdukasi1) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($edukasi->fotoEdukasi1) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($edukasi->fotoEdukasi2) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($edukasi->fotoEdukasi2) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($edukasi->fotoEdukasi3) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($edukasi->fotoEdukasi3) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($edukasi->fotoEdukasi4) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($edukasi->fotoEdukasi4) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
	                        <div class="row">
	                        	
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Judul Lapak</label>
		                            <div class="col-md-9">
		                                {{ $edukasi->title }}
		                            </div>
		                            <br>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Deskripsi Lapak</label>
		                            <div class="col-md-9">
		                                {{ $edukasi->desc }}
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Alamat</label>
		                            <div class="col-md-9">
		                                {{$edukasi->street}} 	<br>
		                                {{$edukasi->village}} 	<br>
		                                {{$edukasi->city}}		<br>
										{{$edukasi->prov}}		<br>
										{{$edukasi->zipCode}}	
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Tanggal Terpesan</label>
		                            <div class="col-md-9">
		                            	{{$edukasi->dateOrdered}}	
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
		                                                $dateOrdered  = "$edukasi->dateOrdered";
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
		                            <label class="col-md-3" align="right">Kuota</label>
		                            <div class="col-md-9">
		                                {{$edukasi->quota}}
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Biaya</label>
		                            <div class="col-md-9">
		                              	{{$edukasi->price}}
		                            </div>
		                        </div>

                        		@if(Auth::user()->userAs == 1)
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="/produkEdukasi/{{$edukasi->id}}/edit" class="btn btn-primary" role="button">Edit Lapak</a>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                </div>
                                @endif
                        	</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
