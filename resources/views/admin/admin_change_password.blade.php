  @extends('admin.admin_dashboard')
  @section('admin')
      <div class="page-content">
          <!--breadcrumb-->
          <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
              <div class="breadcrumb-title pe-3">Admin Change Password</div>
              <div class="ps-3">
                  <nav aria-label="breadcrumb">
                      <ol class="p-0 mb-0 breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                          </li>
                          <li class="breadcrumb-item active" aria-current="page">Admin Change Password </li>
                      </ol>
                  </nav>
              </div>
              <div class="ms-auto">
                  <div class="btn-group">
                      <button type="button" class="btn btn-primary">Settings</button>
                      <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                          data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                              href="javascript:;">Action</a>
                          <a class="dropdown-item" href="javascript:;">Another action</a>
                          <a class="dropdown-item" href="javascript:;">Something else here</a>
                          <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                              link</a>
                      </div>
                  </div>
              </div>
          </div>
          <!--end breadcrumb-->
          <div class="container">
              <div class="main-body">
                  <div class="row">
                      <div class="col-lg-4">
                          <div class="card">
                              <div class="card-body">
                                  <div class="text-center d-flex flex-column align-items-center">
                                      <img src="{{ !empty($profileData->photo) ? url('upload/admin_images . $proifle-photo') : url('upload/no_image.jpg') }}"
                                          alt="Admin" class="p-1 rounded-circle bg-primary" width="110">
                                      <div class="mt-3">
                                          <h4>{{ $profileData->name }}</h4>
                                          <p class="mb-1 text-secondary">{{ $profileData->email }}</p>


                                      </div>
                                  </div>
                                  <hr class="my-4" />
                                  <ul class="list-group list-group-flush">
                                      <li
                                          class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                  height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                  class="feather feather-instagram me-2 icon-inline text-danger">
                                                  <rect x="2" y="2" width="20" height="20" rx="5"
                                                      ry="5"></rect>
                                                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5">
                                                  </line>
                                              </svg>Instagram</h6>
                                          <span class="text-secondary">codervent</span>
                                      </li>
                                      <li
                                          class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                  height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                  class="feather feather-facebook me-2 icon-inline text-primary">
                                                  <path
                                                      d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                  </path>
                                              </svg>Facebook</h6>
                                          <span class="text-secondary">codervent</span>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <form action = "{{ route('admin.password.update') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="col-lg-8">
                              <div class="card">
                                  <div class="card-body">
                                      <div class="mb-3 row">
                                          <div class="col-sm-3">
                                              <h6 class="mb-0">Old Password</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                              <input type="password" name = "old_password"
                                                  class="form-control
                                                  @error('old_password') is-valid @enderror"
                                                  id = "old_password" />

                                              @error('old_password')
                                                  <span class="text_danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>

                                      <div class="mb-3 row">
                                          <div class="col-sm-3">
                                              <h6 class="mb-0">New Password</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                              <input type="password" name = "new_password"
                                                  class="form-control
                                                  @error('new_password') is-invalid @enderror"
                                                  id = "new_password" />

                                              @error('new_password')
                                                  <span class="text_danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="mb-3 row">
                                          <div class="col-sm-3">
                                              <h6 class="mb-0">Comfirm New Password</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                              <input type="password" name = "new_password_confirmation"
                                                  class="form-control
                                                  @error('new_password_confirmation') is-valid @enderror"
                                                  id = "new_password_confirmation" />

                                              @error('new_password_confirmation')
                                                  <span class="text_danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-3"></div>
                                      <div class="col-sm-9 text-secondary">
                                          <input type="submit" class="px-4 btn btn-primary" value="Save Changes" />
                                      </div>
                                  </div>
                              </div>
                          </div>

                  </div>
              </div>
          </div>
      </div>
      </div>
  @endsection
