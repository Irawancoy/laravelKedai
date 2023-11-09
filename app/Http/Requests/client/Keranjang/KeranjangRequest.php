<?php 

namespace App\Http\Requests\Client\Keranjang;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class KeranjangRequest extends FormRequest
{
    // use ConvertsBase64ToFiles;

    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    // protected function base64FileKeys(): array
    // {
    //     return [
    //         'gambar' => 'fotoUser.jpg',
    //     ];
    // }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_customer' => 'required',
            'harga_ruang' => 'required',
            'tamu' => 'required',
            'total' => 'required',
            'tanggal_sewa' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'detail_menu' => 'required|array',
            'detail_ruangan' => 'required|array',
            
            

        ];
    }
      /**
     * Tampilkan pesan error ketika validasi gagal
     *
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
       $this->validator = $validator;
    }


}