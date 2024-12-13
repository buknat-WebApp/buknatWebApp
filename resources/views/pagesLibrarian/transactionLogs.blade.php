@extends('layouts.app')

@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
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
                    <div class="col-md-6">
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
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close">x</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-primary form-control" onclick="startScanner()">
                                                        Scan User QR Code
                                                    </button>
                                                </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display Records -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>Recent Logs</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($records as $record)
                                            <tr>
                                                <td>{{ $record->name }}</td>
                                                <td>{{ $record->created_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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

                    <!-- Audio element -->
                    <audio id="scanSound" src="{{ asset('assets/sounds/beep.mp3') }}" preload="auto"></audio>

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
                            width: 200px;
                            height: 200px;
                            border: 2px solid #fff;
                            border-radius: 20px;
                            box-shadow: 0 0 0 99999px rgba(0, 0, 0, .5);
                        }

                        .scan-region-highlight-svg {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                        }

                        .scanning-line {
                            position: absolute;
                            width: 100%;
                            height: 2px;
                            background: #00ff00;
                            top: 50%;
                            animation: scan 2s linear infinite;
                            opacity: 0.7;
                            filter: drop-shadow(0 0 8px #00ff00);
                        }

                        @keyframes scan {
                            0% { transform: translateY(-50px); }
                            50% { transform: translateY(50px); }
                            100% { transform: translateY(-50px); }
                        }
                    </style>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let scanner = null;
                        // Pre-load the audio
                        const audio = document.getElementById('scanSound');
                        // Create audio context on user interaction
                        let audioContext = null;

                        window.startScanner = function() {
                            // Initialize audio context on user interaction
                            if (!audioContext) {
                                audioContext = new (window.AudioContext || window.webkitAudioContext)();
                            }
                            
                            if (!scanner) {
                                scanner = new Instascan.Scanner({
                                    video: document.getElementById('scanner1'),
                                    scanPeriod: 5,
                                    mirror: false
                                });

                                scanner.addListener('scan', function(content) {
                                    // Updated audio playing logic
                                    try {
                                        audio.currentTime = 0; // Reset audio to start
                                        let playPromise = audio.play();
                                        
                                        if (playPromise !== undefined) {
                                            playPromise.then(() => {
                                                // Audio played successfully
                                            }).catch((error) => {
                                                console.warn("Audio playback failed:", error);
                                            });
                                        }
                                    } catch (error) {
                                        console.error("Audio error:", error);
                                    }
                                    
                                    // Rest of the existing scan handler code...
                                    document.getElementById('search-book-toborrow').value = content;
                                    let modal = bootstrap.Modal.getInstance(document.getElementById('cameraStudentModal'));
                                    modal.hide();
                                    document.getElementById('form-borrow').submit();
                                });
                            }

                            // Start camera
                            Instascan.Camera.getCameras().then(function(cameras) {
                                if (cameras.length > 0) {
                                    // Try to use the back camera if available
                                    let selectedCamera = cameras[cameras.length - 1]; // Usually back camera
                                    scanner.start(selectedCamera).then(() => {
                                        // Show modal after camera starts
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection