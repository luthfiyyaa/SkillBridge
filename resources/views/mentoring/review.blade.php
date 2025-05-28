@extends('layouts.app')

@section('title', 'Review Mentoring')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@section('content')

<style>
.review-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    max-width: 900px;
    margin: 2rem auto;
    padding: 0 1rem;
}

@media (min-width: 768px) {
    .review-container {
        flex-direction: row;
        justify-content: space-between;
    }
}

.review-box {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 2rem 2.5rem;
    width: 500px;
    height: fit-content;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.review-bix {
    background-color: #ffffff;
    border-radius: 1rem;
    padding: 2rem 2.5rem;
    width: 100%;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.review-box:hover {
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}

.review-box-half {
    width: 100%;
}

@media (min-width: 768px) {
    .review-box-half {
        width: 48%;
    }
}

h2 {
    font-weight: 700;
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
    color: #274c77;
    text-align: center;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1a3d7c;
}

select,
textarea,
input[type="number"] {
    width: 100%;
    padding: 0.6rem 0.8rem;
    border: 1.8px solid #6c757d;
    border-radius: 0.5rem;
    margin-bottom: 1.2rem;
    font-size: 1rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: border-color 0.3s ease;
}

select:focus,
textarea:focus,
input[type="number"]:focus {
    border-color: #6096ba;
    outline: none;
}

textarea {
    resize: vertical;
    min-height: 100px;
    font-size: 1rem;
}

button {
    padding: 0.55rem 1.2rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    font-weight: 700;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

button.reset {
    background-color: #6c757d;
    color: white;
}

button.reset:hover {
    background-color: #5a6268;
}

button.submit {
    background-color: #6096ba;
    color: white;
}

button.submit:hover {
    background-color: #407293;
}

.rating-stars {
    display: flex;
    gap: 0.35rem;
    font-size: 1.9rem;
    color: #ffc107;
    cursor: pointer;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.rating-stars i {
    transition: color 0.2s ease;
}

.riwayat-card {
    background: white;
    padding: 1.3rem 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
    margin-bottom: 1.25rem;
    color: #333;
    font-size: 1rem;
}

.riwayat-card p {
    margin: 0.3rem 0;
}

.text-center {
    text-align: center;
    color: #1a3d7c;
}

.text-gray {
    color: #6c757d;
    font-style: italic;
    text-align: center;
    margin-top: 2rem;
    font-size: 1.1rem;
}
</style>

<div class="review-container">

    {{-- Form Feedback --}}
    <div class="review-box review-box-half">
        <h2>Rating Sesi Mentoring</h2>
        <form action="{{ route('review.store') }}" method="POST">
            @csrf

            <label for="jadwal_id">Pilih Sesi</label>
            <select name="jadwal_id" id="jadwal_id" required>
                <option disabled selected>-- Pilih Sesi --</option>
                @foreach ($jadwals as $jadwal)
                    <option value="{{ $jadwal->id }}">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }} - {{ $jadwal->topik }}</option>
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
            <textarea name="komentar" id="komentar" rows="4" placeholder="Tulis komentar atau masukan..."></textarea>

            <div style="display: flex; justify-content: space-between;">
                <button type="reset" class="reset">Batal</button>
                <button type="submit" class="submit">Kirim</button>
            </div>
        </form>
    </div>

    {{-- Riwayat Feedback --}}
    <div class="review-bix review-box-half">
        <h2 class="text-center">Riwayat Mentoring</h2>
        @forelse ($feedbacks as $fb)
            <div class="riwayat-card">
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($fb->jadwal->tanggal)->format('d M Y') }}</p>
                <p><strong>Topik:</strong> {{ $fb->jadwal->topik }}</p>
                <p><strong>Umpan Balik:</strong> {{ $fb->komentar ?: '-' }}</p>
            </div>
        @empty
            <p class="text-gray">Belum ada umpan balik.</p>
        @endforelse
    </div>

</div>

@push('scripts')
<script>
    const stars = document.querySelectorAll('#rating-stars i');
    const input = document.getElementById('rating-input');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            input.value = rating;

            stars.forEach(s => {
                s.classList.remove('fa-solid');
                s.classList.add('fa-regular');
            });

            for (let i = 0; i < rating; i++) {
                stars[i].classList.remove('fa-regular');
                stars[i].classList.add('fa-solid');
            }
        });
    });
</script>
@endpush

@endsection
