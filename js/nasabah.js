$(document).ready(function() {
			$("#nasabah").validate({
				rules: {
				
				alamat_nasabah	: "required",
	 			alamat_dts		: "required",
				alamat_cab		: "required",
				alamat			: "required",
				jenis_kelamin	: "required",
				jabatan			: "required",
				blokir			: "required",
				jenis			: "required",
				tujuan			: "required",
				status			: "required",
				rekening				: {
									required	: true,
					   				acc	: true
									},
				no_rek				: {
									required	: true,
					   				acc	: true
									},
				kode				: {
									required	: true,
					   				lettersonly	: true
									},
				kode_cabang				: {
									required	: true,
					   				number	: true
									},
				nip				: {
									required	: true,
					   				number	: true
									},
				cab				: {
									required	: true,
					   				number	: true
									},
				nama			: 	{
									required	: true,
					   				lettersonly	: true
									},
				ibu_kandung		: 	{
									required	: true,
					   				lettersonly	: true
									},
				pekerjaan		: 	{
									required	: true,
					   				lettersonly	: true
									},
				nama_dts		:	{
									required	: true,
					   				lettersonly	: true
									},
				nama_jaminan		:	{
									required	: true,
					   				lettersonly	: true
									},
				nama_pemilik		:	{
									required	: true,
					   				lettersonly	: true
									},
				alamat_pemilik		:	{
									required	: true,
					   				lettersonly	: true
									},
				hubungan_dts	: 	{
									required	: true,
					   				lettersonly	: true
									},
				tanggal_lahir	:	{
          	 						required	: true,
					   				date		: true
          					   		},
				bunga		: 	{
          	 						required	: true,
					   				number		: true
          					   		},
				lama		: 	{
          	 						required	: true,
					   				number		: true
          					   		},
				besar_angsuran	: 	{
          	 						required	: true,
					   				number		: true
          					   		},
				hp_nasabah		: 	{
          	 						required	: true,
					   				number		: true
          					   		},
				hp_dts			:	{
          	 						required	: true,
					   				number		: true
          					   		},
				tlp			:	{
          	 						required	: true,
					   				number		: true
          					   		},
				wajib			: 	{
          	 						required	: true,
					   				number		: true,
									minlength	: 3,
									maxlength	: 8
          					   		},
				nomor			: 	{
									required	: true,
									minlength	: 4
					   				},
				pokok			: 	{
          	 						required	: true,
					   				number		: true,
									minlength	: 3,
									maxlength	: 8
          					   		},
				nominal			:	{
          	 						required	: true,
					   				number		: true,
									minlength	: 3,
									maxlength	: 8
          					   		},
				jumlah			:	{
          	 						required	: true,
					   				number		: true,
									minlength	: 4,
									maxlength	: 8
          					   		},
				ambil			:	{
          	 						required	: true,
					   				number		: true,
									minlength	: 1,
									maxlength	: 8
          					   		},
				nama_cab		: 	{
									required	: true,
					   				lettersonly	: true
									},	
				tlp_cab			: 	{
          	 						required	: true,
					   				number		: true
          					   		},
				email			: 	{
          	 						required	: true,
					   				email		: true
          					   		},
				nama_jenis		: 	{
									required	: true,
					   				lettersonly	: true
									},
					

				},
			
      	messages: {
			status	:	{
				    				required	: '. Harus di pilih',
			    					
									},
			rekening	:	{
				    				required	: ' Harus di Isi',
			    					acc			: ' Rekening Salah'
									},
			no_rek	:	{
				    				required	: '. Harus di pilih',
			    					acc			: '. Harus di pilih'
									},
			tujuan	:	{
				    				required	: '. Harus di isi'
			    					},
			jenis	:	{
				    				required	: '. Harus di pilih'
			    					},
			blokir	:	{
				    				required	: '. Harus di pilih'
			    					},
			jenis_kelamin	:	{
				    				required	: '. Harus di pilih'
			    					}, 
			jabatan			:	{
				    				required	: '. Harus di pilih'
			    					}, 
				cab			:	{
				    				required	: '. Harus di isi',
									number 		: '. Tidak Ada Pilihan'
			    					},
				nip			:	{
				    				required	: ' Harus di isi',
									number 		: ' Nik Salah'
			    					},
				kode_cabang			:	{
				    				required	: ' Harus di isi',
									number 		: ' Kode Salah'
			    					},
				kode		:	{
				    				required	: '. Harus di isi',
									lettersonly 		: '. Tidak Ada Pilihan'
			    					}, 
				email		:	{
				    				required	: '. Harus di isi',
									email		: '. Email Salah'
			    					},
				nama_jenis	:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
				nama_jaminan:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
			nama_pemilik	:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
			alamat_pemilik	:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					}, 
				nama_cab	:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
				alamat		: 	{
				    				required	: '. Harus di isi'
			    					},
				alamat_cab		: 	{
				    				required	: '. Harus di isi'
			    					},
				besar_angsuran			:	{
				    				required	: '. Harus di isi',
				    				number 		: '. Hanya boleh di isi Angka'
			    					},
				tlp_cab			:	{
				    				required	: '. Harus di isi',
				    				number 		: '. Hanya boleh di isi Angka'
			    					},
				tlp				:	{
				    				required	: '. Harus di isi',
				    				number 		: '. Hanya boleh di isi Angka'
			    					},
			    nama			:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
				tanggal_lahir	:	{
				    				required	: '. Harus di isi',
									date		:'. Format Tanggal salah'
			    					},
				alamat_nasabah	: 	{
				    				required	: '. Harus di isi'
			    					},
				ibu_kandung		:	{
				    				required	: '. Harus di isi',
			    					lettersonly	: '. Hanya Huruf'
									},
				pekerjaan		:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
				nama_dts		:	{
				    				required	: '. Harus di isi',
			    					lettersonly	: '. Hanya Huruf'
									},
				hubungan_dts	:	{
				    				required	: '. Harus di isi',
									lettersonly	: '. Hanya Huruf'
			    					},
				alamat_dts		:	{
				    				required	: '. Harus di isi'
			    					},
				lama		:	{
				    				required	: '. Harus di pilih',
				    				number		: '. Harus di pilih'
			    					},
				bunga		:	{
				    				required	: '. Harus di pilih',
				    				number		: '. Harus di pilih'
			    					},
		      	hp_nasabah		:	{
				    				required	: '. Harus di isi',
				    				number		: '. Hanya boleh di isi Angka'
			    					},
				hp_dts			:	{
				    				required	: '. Harus di isi',
				    				number 		: '. Hanya boleh di isi Angka'
			    					},
				nomor			:	{
				    				required	: '. Harus di isi',
				    				minlength	: '. Harus di isi'
			    					},
				wajib			:	{
				    				required	: '. Harus di isi',
				    				number  	: '. Hanya boleh di isi Angka',
									minlength	: '. Minimal 3 Digit',
									maxlength	: '. Maximal 8 Digit'
			    					},
				pokok			:	{
				    				required	: '. Harus di isi',
				    				number		: '. Hanya boleh di isi Angka',
									minlength	: '. Minimal 3 Digit',
									maxlength	: '. Maximal 8 Digit'
			    					},
				jumlah			:	{
				    				required	: '. Harus di isi',
				    				number  	: '. Hanya boleh di isi Angka',
									minlength	: '. Minimal 4 Digit',
									maxlength	: '. Maximal 8 Digit'
			    					},
				nominal			:	{
				    				required	: '. Harus di isi',
				    				number  	: '. Hanya boleh di isi Angka',
									minlength	: '. Minimal 3 Digit',
									maxlength	: '. Maximal 8 Digit'
			    					},
				ambil			:	{
				    				required	: '. Harus di isi',
				    				number  	: '. Hanya boleh di isi Angka',
									minlength	: '. Minimal 1 Digit',
									maxlength	: '. Maximal 8 Digit'
			    					},
				
			  

			   },
         
         success: function(label) {
            label.text('Ok').addClass('valid');
         }
			});
		});