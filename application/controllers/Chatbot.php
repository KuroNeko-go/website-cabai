<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends CI_Controller {

    public function kirim_pesan() 
    {
        // 1. Tangkap pesan dari form input user
        $pesan_user = $this->input->post('pesan');
        $api_key = $_ENV['GEMINI_API_KEY']; // Ambil kunci lu
        
        // 2. Prompt Engineering (Ini 'Nyawa' Bot-nya)
        $system_instruction = "Kamu adalah asisten virtual bernama 'Putra' dari toko pertanian Duaputra CabaiNusa. Tugasmu menjawab pertanyaan pelanggan tentang bibit, harga cabai, dan cara tanam. Jawablah dengan ramah, singkat, dan berbahasa Indonesia gaul namun sopan. Jangan menjawab di luar konteks pertanian.";

        // 3. Susun koper data (Payload) sesuai aturan API Gemini
        $data = [
            "system_instruction" => [
                "parts" => [
                    ["text" => $system_instruction]
                ]
            ],
            "contents" => [
                [
                    "parts" => [
                        ["text" => $pesan_user]
                    ]
                ]
            ]
        ];

        // 4. Proses Nembak API (cURL)
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $api_key;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($ch);
        curl_close($ch);

        // 5. Bongkar balasan dari Google dan kirim balik ke view
        $hasil = json_decode($response, true);
        
        if (isset($hasil['candidates'][0]['content']['parts'][0]['text'])) {
            $jawaban_ai = $hasil['candidates'][0]['content']['parts'][0]['text'];
            echo json_encode(['status' => 'success', 'balasan' => $jawaban_ai]);
        } else {
            echo json_encode(['status' => 'error', 'balasan' => 'Waduh, sistem lagi sibuk nih. Coba lagi ya!']);
        }
    }
}