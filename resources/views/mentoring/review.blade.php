@extends('layouts.app')

@section('title', 'Review Mentoring')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@section('content')

<style> 
/* Container layout */ 
.review-container { 
    display: flex; 
    flex-direction: column; 
    gap: 2rem; 
} 

@media (min-width: 768px){ 
    .review-container { 
        flex-direction: row; 
        justify-content: space-between; 
        } } 
.review-box { 
    background-color: #cfe2ff; 
    border-radius: 1rem; 
    padding: 1.5rem; 
    width: 100%; 
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
    } 

.review-box-half { 
    width: 100%; 
    } 
    
@media (min-width: 768px) { 
.review-box-half { width: 48%; 
} } 
label { 
    display: block; 
    font-weight: 600; 
    margin-bottom: 0.5rem; 
} 
input[type="number"], 
select, textarea { 
    width: 100%; 
    padding: 0.5rem; 
    border: 1px solid #ccc; 
    border-radius: 0.375rem; 
    margin-bottom: 1rem; 
    } 
textarea { 
    resize: vertical; 
    } 
button { 
    padding: 0.5rem 1rem; 
    border: none; 
    border-radius: 0.375rem; 
    cursor: pointer; 
    } 

button.reset { 
    background-color: #6c757d; 
    color: white; 
    } 

button.submit { 
    background-color: #0d6efd; 
    color: white; 
    } 

.rating-stars { 
    display: flex; 
    gap: 0.25rem; 
    font-size: 1.5rem; 
    color: #ffc107; 
    cursor: pointer; 
    } 

.rating-stars i { 
    transition: color 0.2s; 
    } 
    
.riwayat-card { 
    background: white; 
    padding: 1rem; 
    border-radius: 0.5rem; 
    box-shadow: 0 2px 6px rgba(0,0,0,0.1); 
    margin-bottom: 1rem; 
    } 

.text-center { 
    text-align: center; 
    } 

.text-gray { 
    color: #6c757d;
    } 

</style> 

<div class="review-container">

{{-- Form Feedback --}}
<div class="review-box review-box-half">
    <h2 class="text-lg font-semibold mb-4">Rating Sesi Mentoring</h2>
    <form action="{{ route('review.store') }}" method="POST">
        @csrf

        <label for="jadwal_id">Pilih Sesi</label>
        <select name="jadwal_id" id="jadwal_id" required>
            <option disabled selected>-- Pilih Sesi --</option>
            @foreach ($jadwals as $jadwal)
                <option value="{{ $jadwal->id }}">{{ $jadwal->tanggal }} - {{ $jadwal->topik }}</option>
            @endforeach
        </select>

        <label>Rating</label>
        <div id="rating-stars" class="rating-stars">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa-regular fa-star" data-value="{{ $i }}"></i>
            @endfor
        </div>
        <input type="hidden" name="rating" id="rating-input" value="0">

        <label for="komentar">Komentar</label>
        <textarea name="komentar" id="komentar" rows="3"></textarea>

        <div style="display: flex; justify-content: space-between;">
            <button type="reset" class="reset">Batal</button>
            <button type="submit" class="submit">Kirim</button>
        </div>
    </form>
</div>

{{-- Riwayat Feedback --}}
<div class="review-box review-box-half">
    <h2 class="text-center">Riwayat Mentoring</h2>
    @forelse ($feedbacks as $fb)
        <div class="riwayat-card">
            <p><strong>Tanggal:</strong> {{ $fb->jadwal->tanggal }}</p>
            <p><strong>Topik:</strong> {{ $fb->jadwal->topik }}</p>
            <p><strong>Umpan Balik:</strong> {{ $fb->komentar }}</p>
        </div>
    @empty
        <p class="text-gray">Belum ada umpan balik.</p>
    @endforelse
</div>
</div>
{{-- Script Rating Bintang --}}
@push('scripts')

<script> const stars = document.querySelectorAll('#rating-stars i'); const input = document.getElementById('rating-input'); stars.forEach(star => { star.addEventListener('click', () => { const rating = star.getAttribute('data-value'); input.value = rating; stars.forEach(s => { s.classList.remove('fa-solid'); s.classList.add('fa-regular'); }); for (let i = 0; i < rating; i++) { stars[i].classList.remove('fa-regular'); stars[i].classList.add('fa-solid'); } }); }); </script>
@endpush

@endsection