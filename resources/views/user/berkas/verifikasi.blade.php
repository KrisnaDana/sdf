<!DOCTYPE html>
<html>
	<head>
		<title>Form Verifikasi</title>
		<style type="text/css">
			@page { 
				margin: 1cm 3cm 2cm 3cm; 
			}

			#cutting{
				position:fixed;
				padding:10px;
				margin: 0.5cm 0.5cm -0.5cm 0.5cm;
				border:1.5px dashed #000000;
			}
			
			#outtable{
				position:fixed;
				padding:0;
				margin: 1cm 1cm 0.5cm 1cm;
				border:5px solid #000000;
			}
			#watermark { 
				position: fixed; bottom: 100px; left: 5px; right: 5px; width: 550px; height: 550px; opacity: .1; 
			}

            .hideextra { white-space: nowrap; overflow: hidden; text-overflow:ellipsis; }
			
			body {
				margin-top:0;
				padding:0px;
			}
			
			table.tabel1{
				width : 100%;
				font-family:  "Times New Roman", Times, serif;
				text-align: center;
				color:#000000;
			}
			table.tabel1 td{
				font-size: 18px;
				padding-left: 10px;
				font-style:normal; 
				font-weight:bold
			}
			
			table.tabel2{
				border-collapse: collapse;
				width : 100%;
				font-family: "Times New Roman", Times, serif;
				color:#000000;
				border: 2px solid black;
				
			}
			table.tabel2 th{
				border: 1px solid black;

			}table.tabel2 td{
				padding-left: 5px;
				border: 1px solid black;
			}
		</style>
	</head>
	<body>
		<table class="tabel1">
			<tr>
				<td rowspan="6" style='width: 5%;'><img src="{{ public_path('img/UNUD.png') }}" alt="" height="100px" width="100px"></td>
				<td style='width: 90%;'>&nbsp;</td>
				<td rowspan="6" style='width: 5%;'><img src="{{ public_path('img/TEKNIK_1.png') }}" alt="" height="100px" width="100px"></td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td style='text-align: center; font-size:20px;'>STUDENT DAY - PKKMB {{ date('Y') }}</td>
			</tr>
			<tr>
				<td style='text-align: center; font-size:14px;'>FAKULTAS TEKNIK UNIVERSITAS UDAYANA</td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="3" style='width: 100%; font-size: 1px; border-top: 4px solid #ffffff;'>&nbsp;</td>
			</tr>
            <tr>
				<td colspan="3" style='width: 100%; font-size: 1px; border-top: 4px solid #000000;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style='width: 100%; font-size: 1px; border-top: 2px solid #000000;'>&nbsp;</td>
			</tr>
		</table>
		<table class="tabel2">
			<tr>
				<td colspan="8" style='text-align: center; font-size: 20px; font-weight:bold; border: 2px solid black; text-transform: uppercase;'>BIODATA MAHASISWA {{ $program_studi }}</td>
			</tr>
			<tr>
				<td colspan="1">Nama</td>
				<td class="hideextra" colspan="7" style='text-transform: uppercase;'>
					{{ $user->nama_lengkap }}
				</td>
				
			</tr>
			<tr>
				<td colspan="1">Nama Panggilan</td>
				<td colspan="3" style='text-transform: uppercase;' class="hideextra">
					{{ $user->nama_panggilan }}
				</td>
				<td colspan="4">
                    Jenis Kelamin : <span style='text-transform: uppercase;'>{{ $user->jenis_kelamin }}</span>
				</td>
			</tr>
			<tr>
				<td colspan="1">NIM</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->nim }}
				</td>
			</tr>
			<tr>
				<td colspan="1">TTL</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->tempat_lahir }}, {{ date('d-m-Y', strtotime($user->tanggal_lahir)) }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Agama</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->agama }}
  				</td>
			</tr>
			<tr>
				<td colspan="1" rowspan="2" style='vertical-align: middle;'>Alamat</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">Asal : {{ $user->alamat_asal }}</td>
			</tr>
			<tr>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">Sekarang : {{ $user->alamat_sekarang }}</td>
			</tr>
			<tr>
				<td colspan="1">No. Tlp</td>
				<td colspan="3" class="hideextra">{{ $user->no_telepon }}</td>
				<td colspan="4" class="hideextra">HP. {{ $user->no_hp }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Email</td>
				<td colspan="7" class="hideextra">
					{{ $user->email }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Minat Bakat</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->minat_bakat }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Asal Sekolah</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->asal_sekolah }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Cita-cita</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->cita_cita }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Tokoh Idola</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->idola }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Jumlah Saudara</td>
				<td style='text-transform: uppercase;' colspan="3" class="hideextra">
					{{ $user->jumlah_saudara }}
				</td>
				<td colspan="4" class="hideextra">Golongan Darah : {{ $user->golongan_darah }}</td>
			</tr>
			<tr>
				<td colspan="1">Nama Ayah</td>
				<td colspan="7" style='text-transform: uppercase;'class="hideextra">
					{{ $user->nama_ayah }}
				</td>
			</tr>
			<tr>
				<td colspan="1">Nama Ibu</td>
				<td colspan="7" style='text-transform: uppercase;' class="hideextra">
					{{ $user->nama_ibu }}
				</td>
			</tr>
			<tr>
				<td style='vertical-align: top;' colspan="1">Organisasi</td>
				<td colspan="7" style='text-transform: uppercase;vertical-align: top;' class="hideextra">
					@if(count($organisasis))
						<?php $first = true ?>
						@foreach($organisasis as $organisasi)
							@if ($first)
								{{ $organisasi->nama }}
								<?php $first = false ?>
							@else
								{{ ", ".$organisasi->nama }}
							@endif
						@endforeach
					@else
						Tidak Ada
					@endif
				</td>
			</tr>
			<tr>
				<td style='vertical-align: top;' colspan="1">Prestasi</td>
				<td colspan="7" style='text-transform: uppercase; vertical-align: middle;' class="hideextra">
					@if(count($prestasis))
						<?php $first = true ?>
						@foreach($prestasis as $prestasi)
							@if($first)
								{{ $prestasi->nama }}
								<?php $first = false ?>
							@else
								{{ ", ".$prestasi->nama }}
							@endif
						@endforeach
					@else
						Tidak Ada
					@endif
				</td>
			</tr>
			<tr>
				<td style='vertical-align: top; ' colspan="1">Alasan Kuliah</td>
				<td colspan="7" style='text-transform: uppercase; vertical-align: middle;' class="hideextra">
					{{ $user->alasan_kuliah }}
				</td>
			</tr>
            <tr>
				<td style='vertical-align: top; ' colspan="1">Konsumsi</td>
				<td colspan="7" style='text-transform: uppercase; vertical-align: middle;' class="hideextra">
					{{ $user->konsumsi }}
				</td>
			</tr>
			<tr>
				<td colspan="8" style='border-bottom:none; border-top:none;' >&nbsp;</td>
			</tr>
			<tr>
                <td colspan="8" style='border-bottom:none; border-top:none;' >&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="8" colspan="2" style='vertical-align: top; padding-left: 50px; border-style: none;'><img src="{{ $user->pas_foto ? public_path('mahasiswa/pas_foto/'.$user->pas_foto) : public_path('img/foto3x4.jpg') }}" alt="" height=150px width=120px></td>
				<td colspan="6" style='text-align: center; border-bottom:none; border-top:none; border-left:none;'>Denpasar, ___________________{{ date('Y') }}</td>
			</tr>
			<tr>
				<td colspan="6"style='text-align: center; border-style: none;'>Biodata diisi dengan sebenar-benarnya</td>
			</tr>
			<tr>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'></td>
			</tr>
			<tr>
				<td colspan="6" style='text-align: center; border-bottom:none; border-top:none; border-left:none;'>(.............................................................)</td>
			</tr>
			<tr>
				<td colspan="2" style='border-style:none;'>&nbsp;</td>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style='border-style:none;'>&nbsp;</td>
				<td colspan="6" style='border-bottom:none; border-top:none; border-left:none;'>&nbsp;</td>
			</tr>
		</table>
	</body>
</html>
