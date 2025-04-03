@extends('layouts.app')

@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                        href="{{ route('guestForm') }}">
                                        <i class="fas fa-user"></i>
                                        <span class="ms-2">Guest Attendance</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
            <div class="row gx-4">
            <div class="col-auto my-auto">
                
                <div class="h-100">
                    <h5 class="mb-1">
                        Attendance Log
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        In this page, the librarian can scan students' QR codes
                    </p>
                </div>
            </div>
            <div class="container-fluid py-4 mt-2">
                <div class="row">
                    <div class="col-md-10 m-auto mb-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-uppercase text-sm">User Attendance</p>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                @if (session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <p class="text-center text-white">
                                                            {{ session('success') }}
                                                        </p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                                    </div>
                                                @endif

                                                @if (session('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <p class="text-center text-white">
                                                            {{ session('error') }}
                                                        </p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                                    </div>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <form method="POST" action="{{ route('recordLogins') }}" id="form-borrow">
                                                    @csrf
                                                    <div class="col mt-3">
                                                        <input type="text" id="search-book-toborrow" name="qr_code"
                                                            placeholder="Type your LRN Number or Scan" class="form-control">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="row">
                                                <button type="button" id="submitBtn" class="btn btn-success mt-3"
                                                    onclick="submitForm()">
                                                    Submit
                                                </button>
                                            </div>
                                            
                                            <div class="row">
                                            
                                                    <button class="btn btn-primary form-control bg-primary bg-gradient" onclick="startScanner()">
                                                        Scan User QR Code
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display Records -->
                    <div class="col-md-15">
                        <div class="card">
                            <div class="card-body">
                                <h5>Recent Logs</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Date & Time</th>
                                                <th class="text-start">Name</th>
                                                <th class="text-start">Grade</th>
                                                <th class="text-start">Section</th>
                                                <th class="text-start">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($records->take(50) as $record)
                                            <tr>
                                                <td class="text-start">{{ $record->created_at->format('M d, Y h:i A') }}</td>
                                                <td class="text-start text-capitalize">{{ $record->name }}</td>
                                                <td class="text-start">{{ $record->grade_and_section ?? ''}}</td>
                                                <td class="text-start text-capitalize">{{ $record->section ?? ''}}</td>
                                                <td class="text-start">
                                                <form action="{{ route('delete.student.logbook', $record->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this attendance log?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm bg-danger bg-gradient" title="Delete this Log?">
                                                        <i class="fas fa-trash"> Delete</i> 
                                                    </button>
                                                </form>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Camera Modal -->
                    <div class="modal fade" id="cameraStudentModal" tabindex="-1" role="dialog" aria-labelledby="scannerModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="scannerModalLabel">Scan QR Code</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="scanner-container">
                                        <video id="scanner1"></video>
                                        <div class="scan-region-highlight">
                                            <div class="scan-region-highlight-svg">
                                                <!-- Corner markers -->
                                                <svg width="100%" height="100%" viewBox="0 0 200 200">
                                                    <path d="M10,0 L0,0 L0,10" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                    <path d="M190,0 L200,0 L200,10" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                    <path d="M10,200 L0,200 L0,190" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                    <path d="M190,200 L200,200 L200,190" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                </svg>
                                            </div>
                                            <div class="scanning-line"></div>
                                        </div>
                                    </div>
                                    <div class="text-center py-2">
                                        <small class="text-muted">Align QR code within the frame</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
                        .scanner-container {
                            position: relative;
                            width: 100%;
                            height: 300px;
                            overflow: hidden;
                            background: #000;
                        }

                        #scanner1 {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }

                        .scan-region-highlight {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 250px;
                            height: 250px;
                            
                            border-radius: 10px;
                            box-shadow: 0 0 0 99999px rgba(0, 0, 0, .5);
                        }

                        .scan-region-highlight-svg {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                        }
                    </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let scanner = null;
    const audio = new Audio("{{ asset('assets/sounds/beep.mp3') }}");

    
    // Automatically start scanner when page loads
    setTimeout(() => {
        startScanner();
    }, 1000); // Small delay to ensure everything is loaded

    window.startScanner = function() {
        if (!scanner) {

             // Create canvas context with willReadFrequently flag
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d', { willReadFrequently: true });

            scanner = new Instascan.Scanner({
                video: document.getElementById('scanner1'),
                scanPeriod: 5,
                mirror: false,

                 // Pass the optimized canvas context
                 canvas: canvas
            });

            scanner.addListener('scan', async function(content) {
                try {
                     // Play sound
                     audio.currentTime = 0;
                    audio.play().catch(function(error) {
                        console.log("Audio play failed:", error);
                    });
                    
                    // Process the scan
                    document.getElementById('search-book-toborrow').value = content;
                    let modal = bootstrap.Modal.getInstance(document.getElementById('cameraStudentModal'));
                    if (modal) {
                        modal.hide();
                    }
                    document.getElementById('search-book-toborrow').focus();
                    
                    // Add small delay to ensure sound plays before form submission
                    setTimeout(() => {
                        document.getElementById('form-borrow').submit();
                    }, 500);
                    
                } catch(error) {
                    console.error("Error processing scan:", error);
                }
            });
        }

        // Start camera
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                let selectedCamera = cameras[cameras.length - 1];
                scanner.start(selectedCamera).then(() => {
                    let modal = new bootstrap.Modal(document.getElementById('cameraStudentModal'));
                    modal.show();
                }).catch(function(e) {
                    console.error('Failed to start camera:', e);
                    alert('Failed to start camera: ' + e.message);
                });
            } else {
                console.error('No cameras found.');
                alert('No cameras found on your device.');
            }
        }).catch(function(e) {
            console.error('Error accessing cameras:', e);
            alert('Error accessing camera. Please ensure you have given camera permissions: ' + e.message);
        });
    };

    // Stop scanner when modal is closed
    document.getElementById('cameraStudentModal').addEventListener('hidden.bs.modal', function() {
        if (scanner) {
            scanner.stop();
        }
    });

    // For debugging
    window.addEventListener('error', function(e) {
        console.error('Global error:', e);
    });
});

function submitForm() {
    document.getElementById('form-borrow').submit();
}
</script>
@endsection