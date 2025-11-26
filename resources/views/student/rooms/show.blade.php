@extends('layouts.frontend')

@section('title', 'Room Details')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container" data-aos="fade-up">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3 text-white-50">
                <a href="{{ route('student.rooms') }}" class="text-white-50" style="text-decoration: none;">Rooms</a>
                <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i>
                <span>Details</span>
            </div>
            <h1 class="page-title">{{ $room->block->name }} - Room {{ $room->room_number }}</h1>
            <p class="text-white-50" style="font-size: 1.2rem;">
                {{ ucfirst($room->room_type) }} Room &bull; {{ $room->floor }} Floor
            </p>
        </div>
    </div>

    <div class="container section-padding">
        @if(session('error'))
            <div class="alert alert-danger mb-4" data-aos="fade-in">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-2" style="grid-template-columns: 1.5fr 1fr; gap: 3rem;">
            <!-- Left Column: Image & Description -->
            <div data-aos="fade-right">
                <div class="mb-5">
                    @php
                        $roomImages = [
                            'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'https://images.unsplash.com/photo-1522771753035-4a50356c6518?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                        ];
                        $imageIndex = $room->id % count($roomImages);
                    @endphp
                    <img src="{{ $roomImages[$imageIndex] }}" alt="Room Image" class="room-detail-img shadow-lg">
                </div>

                <div class="mb-5">
                    <h3 class="mb-3">About this Room</h3>
                    <p class="text-muted" style="line-height: 1.8; font-size: 1.1rem;">
                        Experience premium student living in this spacious {{ $room->room_type }} room located on the {{ $room->floor }} floor of {{ $room->block->name }}. 
                        Designed for both comfort and productivity, this room offers a quiet environment with plenty of natural light.
                        You'll have access to all common areas, high-speed internet, and 24/7 security.
                    </p>
                </div>
                
                <div class="mb-5">
                    <h3 class="mb-4">Amenities & Features</h3>
                    <div class="grid grid-2">
                        <div class="amenity-item">
                            <i class="fas fa-wifi text-primary fa-lg"></i>
                            <div>
                                <strong>High-Speed Wi-Fi</strong>
                                <small class="d-block text-muted">Unlimited access</small>
                            </div>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-bed text-primary fa-lg"></i>
                            <div>
                                <strong>Premium Bedding</strong>
                                <small class="d-block text-muted">Comfortable mattress</small>
                            </div>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-table text-primary fa-lg"></i>
                            <div>
                                <strong>Study Station</strong>
                                <small class="d-block text-muted">Desk & ergonomic chair</small>
                            </div>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-tshirt text-primary fa-lg"></i>
                            <div>
                                <strong>Wardrobe</strong>
                                <small class="d-block text-muted">Spacious storage</small>
                            </div>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-shield-alt text-primary fa-lg"></i>
                            <div>
                                <strong>24/7 Security</strong>
                                <small class="d-block text-muted">Biometric access</small>
                            </div>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-broom text-primary fa-lg"></i>
                            <div>
                                <strong>Housekeeping</strong>
                                <small class="d-block text-muted">Weekly cleaning</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Booking Details -->
            <div data-aos="fade-left">
                <div class="booking-card">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <span class="text-muted d-block mb-1">Semester Fee</span>
                            <h2 class="text-primary mb-0">KSh {{ number_format($room->price_per_semester) }}</h2>
                        </div>
                        <span class="badge badge-success" style="font-size: 1rem; padding: 0.5rem 1rem;">Available</span>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Block</span>
                            <strong>{{ $room->block->name }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Room No.</span>
                            <strong>{{ $room->room_number }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Type</span>
                            <strong>{{ ucfirst($room->room_type) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Capacity</span>
                            <strong>{{ $room->occupied }} / {{ $room->capacity }} Students</strong>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary w-100 btn-lg mb-3" onclick="openPaymentModal()">
                        Book Now
                    </button>
                    
                    <p class="text-center text-muted small mb-0">
                        <i class="fas fa-lock mr-1"></i> Secure payment via M-Pesa or PayPal
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="modal-overlay">
        <div class="modal-content">
            <button type="button" onclick="closePaymentModal()" style="position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999;">&times;</button>
            
            <div class="text-center mb-4">
                <h3 class="mb-2">Complete Booking</h3>
                <p class="text-muted">Secure your room with a payment</p>
            </div>
            
            <form action="{{ route('student.bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="amount" value="{{ $room->price_per_semester }}">
                
                <div class="mb-4">
                    <label class="form-label">Select Payment Method</label>
                    <div class="d-flex flex-column gap-2">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="mpesa" checked onchange="togglePhoneInput(this)">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/M-PESA_LOGO-01.svg/1200px-M-PESA_LOGO-01.svg.png" alt="M-Pesa" style="height: 24px;">
                            <span class="flex-grow-1">M-Pesa</span>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="paypal" onchange="togglePhoneInput(this)">
                            <i class="fab fa-paypal fa-2x text-primary"></i>
                            <span class="flex-grow-1">PayPal</span>
                        </label>
                    </div>
                </div>

                <div id="phoneInputGroup" class="mb-4">
                    <label class="form-label">M-Pesa Phone Number</label>
                    <div class="position-relative">
                        <input type="text" name="phone_number" class="form-control" placeholder="0712345678" required style="padding-left: 3rem;">
                        <i class="fas fa-phone position-absolute text-muted" style="left: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    </div>
                    <small class="text-muted mt-1 d-block">You will receive a payment prompt on this number.</small>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                    <span>Total to Pay:</span>
                    <strong class="text-primary h4 mb-0">KSh {{ number_format($room->price_per_semester) }}</strong>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg">
                    Pay & Confirm
                </button>
            </form>
        </div>
    </div>

    <script>
        function openPaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function togglePhoneInput(radio) {
            const phoneGroup = document.getElementById('phoneInputGroup');
            const phoneInput = phoneGroup.querySelector('input');
            
            if (radio.value === 'mpesa') {
                phoneGroup.style.display = 'block';
                phoneInput.required = true;
            } else {
                phoneGroup.style.display = 'none';
                phoneInput.required = false;
            }
        }

        // Close modal on outside click
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentModal();
            }
        });
    </script>

    <style>
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
        .shadow-lg { box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
    </style>
@endsection
