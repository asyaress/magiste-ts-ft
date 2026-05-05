@extends('layout/main')

@php
    $v = fn(string $key, string $default = '') => old($key, $settings[$key] ?? $default);
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                <h1 class="mb-3">Site Settings</h1>

                <div class="card">
                    <form action="{{ route('admin.site-settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h5 class="mb-3">Kontak & Header</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>WhatsApp</label>
                                    <input type="text" name="contact_whatsapp" class="form-control" value="{{ $v('contact_whatsapp', '08xx-xxxx-xxxx') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" name="contact_email" class="form-control" value="{{ $v('contact_email', 'email@unmul.ac.id') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact URL</label>
                                    <input type="url" name="contact_link_url" class="form-control" value="{{ $v('contact_link_url') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Header Location Label</label>
                                    <input type="text" name="header_location_label" class="form-control" value="{{ $v('header_location_label', 'Lokasi Kampus') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Header CTA Text</label>
                                    <input type="text" name="header_cta_text" class="form-control" value="{{ $v('header_cta_text', 'Hubungi Kami') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Footer Contact Title</label>
                                    <input type="text" name="footer_contact_title" class="form-control" value="{{ $v('footer_contact_title', 'Kontak & Lokasi') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Header Location Text</label>
                                <textarea name="header_location_text" rows="2" class="form-control">{{ $v('header_location_text', 'Gedung Fakultas Teknik, Jl. Sambaliung No.9' . PHP_EOL . 'Kampus Gunung Kelua, Samarinda') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Footer Contact Address HTML</label>
                                <textarea name="footer_contact_address_html" rows="3" class="form-control">{{ $v('footer_contact_address_html') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Footer Contact Note</label>
                                <textarea name="footer_contact_note" rows="2" class="form-control">{{ $v('footer_contact_note') }}</textarea>
                            </div>

                            <hr>
                            <h5 class="mb-3">Sosial Media</h5>
                            <div class="form-row">
                                <div class="form-group col-md-3"><label>Facebook</label><input type="url" name="social_facebook" class="form-control" value="{{ $v('social_facebook') }}"></div>
                                <div class="form-group col-md-3"><label>Twitter</label><input type="url" name="social_twitter" class="form-control" value="{{ $v('social_twitter') }}"></div>
                                <div class="form-group col-md-3"><label>LinkedIn</label><input type="url" name="social_linkedin" class="form-control" value="{{ $v('social_linkedin') }}"></div>
                                <div class="form-group col-md-3"><label>Instagram</label><input type="url" name="social_instagram" class="form-control" value="{{ $v('social_instagram') }}"></div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Section Visi & Misi</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4"><label>Subtitle</label><input type="text" name="service_section_subtitle" class="form-control" value="{{ $v('service_section_subtitle', 'Visi & Misi') }}"></div>
                                <div class="form-group col-md-4"><label>Title Line 1</label><input type="text" name="service_section_title_line1" class="form-control" value="{{ $v('service_section_title_line1', 'Program Magister (S2) Teknik Sipil') }}"></div>
                                <div class="form-group col-md-4"><label>Title Line 2</label><input type="text" name="service_section_title_line2" class="form-control" value="{{ $v('service_section_title_line2', 'Universitas Mulawarman') }}"></div>
                            </div>
                            <div class="form-group">
                                <label>Teks Visi</label>
                                <textarea name="service_section_vision_text" rows="3" class="form-control">{{ $v('service_section_vision_text') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Teks Pengantar Misi</label>
                                <textarea name="service_section_mission_intro" rows="2" class="form-control">{{ $v('service_section_mission_intro') }}</textarea>
                            </div>

                            <hr>
                            <h5 class="mb-3">Section About</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4"><label>Subtitle</label><input type="text" name="about_section_subtitle" class="form-control" value="{{ $v('about_section_subtitle', 'Tentang Program') }}"></div>
                                <div class="form-group col-md-4"><label>Title Line 1</label><input type="text" name="about_section_title_line1" class="form-control" value="{{ $v('about_section_title_line1', 'Magister (S2) Teknik Sipil') }}"></div>
                                <div class="form-group col-md-4"><label>Title Line 2</label><input type="text" name="about_section_title_line2" class="form-control" value="{{ $v('about_section_title_line2', 'Universitas Mulawarman') }}"></div>
                            </div>
                            <div class="form-group">
                                <label>Headline</label>
                                <textarea name="about_section_headline" rows="2" class="form-control">{{ $v('about_section_headline') }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2"><label>Stat 1 Value</label><input type="text" name="about_stat_1_value" class="form-control" value="{{ $v('about_stat_1_value', '24') }}"></div>
                                <div class="form-group col-md-2"><label>Stat 1 Label</label><input type="text" name="about_stat_1_label" class="form-control" value="{{ $v('about_stat_1_label', 'Dosen') }}"></div>
                                <div class="form-group col-md-2"><label>Stat 2 Value</label><input type="text" name="about_stat_2_value" class="form-control" value="{{ $v('about_stat_2_value', '180+') }}"></div>
                                <div class="form-group col-md-2"><label>Stat 2 Label</label><input type="text" name="about_stat_2_label" class="form-control" value="{{ $v('about_stat_2_label', 'Mahasiswa Aktif') }}"></div>
                                <div class="form-group col-md-2"><label>Stat 3 Value</label><input type="text" name="about_stat_3_value" class="form-control" value="{{ $v('about_stat_3_value', '6') }}"></div>
                                <div class="form-group col-md-2"><label>Stat 3 Label</label><input type="text" name="about_stat_3_label" class="form-control" value="{{ $v('about_stat_3_label', 'Laboratorium') }}"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8"><label>Image Path/URL</label><input type="text" name="about_image_path" class="form-control" value="{{ $v('about_image_path', 'assets/images/depan4.png') }}"></div>
                                <div class="form-group col-md-4"><label>Image Alt</label><input type="text" name="about_image_alt" class="form-control" value="{{ $v('about_image_alt') }}"></div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Section FAQ</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4"><label>Subtitle</label><input type="text" name="faq_section_subtitle" class="form-control" value="{{ $v('faq_section_subtitle', 'Alur Pendaftaran & Ketentuan') }}"></div>
                                <div class="form-group col-md-4"><label>Title Line 1</label><input type="text" name="faq_section_title_line1" class="form-control" value="{{ $v('faq_section_title_line1', 'Langkah-langkah Pendaftaran') }}"></div>
                                <div class="form-group col-md-4"><label>Title Line 2</label><input type="text" name="faq_section_title_line2" class="form-control" value="{{ $v('faq_section_title_line2', '- S2 Teknik Sipil UNMUL') }}"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8"><label>FAQ Image Path/URL</label><input type="text" name="faq_image_path" class="form-control" value="{{ $v('faq_image_path', 'assets/images/depan5.jpg') }}"></div>
                                <div class="form-group col-md-4"><label>FAQ Image Alt</label><input type="text" name="faq_image_alt" class="form-control" value="{{ $v('faq_image_alt') }}"></div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Footer About</h5>
                            <div class="form-group">
                                <label>Footer About Text</label>
                                <textarea name="footer_about_text" rows="4" class="form-control">{{ $v('footer_about_text') }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
