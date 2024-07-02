<div class="content">

    <!-- Inner container -->
    <div class="d-lg-flex align-items-lg-start">

        <!-- Left sidebar component -->
        <div
            class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-none sidebar-expand-lg">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Navigation -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle"
                                src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }}" width="170"
                                height="170" alt="">
                            <div class="card-img-actions-overlay rounded-circle">
                                <a href="#" class="btn btn-outline-white border-2 btn-icon rounded-pill">
                                    <i class="icon-plus3"></i>
                                </a>
                                <a href="user_pages_profile.html"
                                    class="btn btn-outline-white border-2 btn-icon rounded-pill ml-2">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0">{{ Auth::guard('provider')->user()->name }}</h6>
                        <span class="d-block opacity-75">Head of UX</span>
                    </div>

                    <ul class="nav nav-sidebar">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active" data-toggle="tab">
                                <i class="icon-user"></i>
                                My profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#inbox" class="nav-link" data-toggle="tab">
                                <i class="icon-envelop2"></i>
                                Inbox
                                <span class="badge badge-dark badge-pill ml-auto">29</span>
                            </a>
                        </li>
                        <li class="nav-item-divider"></li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link" data-toggle="tab">
                                <i class="icon-switch2"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /left sidebar component -->


        <!-- Right content -->
        <div class="tab-content flex-1">
            <div class="tab-pane fade active show" id="profile">

                <!-- Profile info -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Profile information</h6>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <fieldset class="mb-3">
                                <div class="row">

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Organization</label>
                                            <select id="organization_id" name="organization_id"
                                                class="form-control select-search" data-fouc>
                                                <option value="{{ $userProfile->organization_id }}">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Organogram</label>
                                            <select id="organogram_ids" name="organogram_ids"
                                                class="form-control select-search" data-fouc>
                                                <option value="{{ $userProfile->organogram_ids }}">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select id="role_id" name="role_id" class="form-control select-search"
                                                data-fouc required>
                                                <option value="{{ $userProfile->role_id }}">{{ $userProfile->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" maxlength="50"
                                                class="form-control maxlength-options" value="{{ $userProfile->name }}"
                                                placeholder="Enter Your Name" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" id="email" name="email" maxlength="100"
                                                class="form-control maxlength-options" value="{{ $userProfile->email }}"
                                                placeholder="Enter Your Email Address" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" id="phone" name="phone" maxlength="11"
                                                class="form-control maxlength-options"
                                                value="{{ $userProfile->phone }}"
                                                placeholder="Enter Your Phone Number">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" maxlength="30"
                                                class="form-control maxlength-options" autocomplete="off"
                                                placeholder="Enter Your Password">
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>

                                </div>


                            </fieldset>
                            <div class="d-flex justify-content-end align-items-center">
                                <button id="reset" type="reset" class="btn btn-danger">Reset <i
                                        class="icon-reload-alt ml-2"></i></button>
                                <button id="submit" class="btn btn-success ml-3 form-submit-btn">Submit <i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /profile info -->


                <!-- Account settings -->
                {{-- <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Account settings</h6>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Username</label>
                                        <input type="text" value="Kopyov" readonly="readonly"
                                            class="form-control">
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Current password</label>
                                        <input type="password" value="password" readonly="readonly"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>New password</label>
                                        <input type="password" placeholder="Enter new password" class="form-control">
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Repeat password</label>
                                        <input type="password" placeholder="Repeat new password"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Profile visibility</label>

                                        <label class="custom-control custom-radio mb-2">
                                            <input type="radio" name="visibility" class="custom-control-input"
                                                checked>
                                            <span class="custom-control-label">Visible to everyone</span>
                                        </label>

                                        <label class="custom-control custom-radio mb-2">
                                            <input type="radio" name="visibility" class="custom-control-input">
                                            <span class="custom-control-label">Visible to friends only</span>
                                        </label>

                                        <label class="custom-control custom-radio mb-2">
                                            <input type="radio" name="visibility" class="custom-control-input">
                                            <span class="custom-control-label">Visible to my connections only</span>
                                        </label>

                                        <label class="custom-control custom-radio">
                                            <input type="radio" name="visibility" class="custom-control-input">
                                            <span class="custom-control-label">Visible to my colleagues only</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Notifications</label>

                                        <label class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" checked>
                                            <span class="custom-control-label">Password expiration notification</span>
                                        </label>

                                        <label class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" checked>
                                            <span class="custom-control-label">New message notification</span>
                                        </label>

                                        <label class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" checked>
                                            <span class="custom-control-label">New task notification</span>
                                        </label>

                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label">New contact request notification</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!-- /account settings -->

            </div>

            <div class="tab-pane fade" id="inbox">

                <!-- My inbox -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title">My inbox</h6>

                        <div class="header-elements">
                            <span class="badge badge-primary">25 new today</span>
                        </div>
                    </div>

                    <!-- Action toolbar -->
                    <div class="navbar navbar-light navbar-expand-lg border-bottom-0 shadow-none py-lg-2">
                        <div class="text-center d-lg-none w-100">
                            <button type="button" class="navbar-toggler w-100" data-toggle="collapse"
                                data-target="#inbox-toolbar-toggle-multiple">
                                <i class="icon-circle-down2"></i>
                            </button>
                        </div>

                        <div class="navbar-collapse text-center text-lg-left flex-wrap collapse"
                            id="inbox-toolbar-toggle-multiple">
                            <div class="mt-3 mt-lg-0">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light btn-icon btn-checkbox-all">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </button>

                                    <button type="button" class="btn btn-light btn-icon dropdown-toggle"
                                        data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item">Select all</a>
                                        <a href="#" class="dropdown-item">Select read</a>
                                        <a href="#" class="dropdown-item">Select unread</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">Clear selection</a>
                                    </div>
                                </div>

                                <div class="btn-group ml-3 mr-lg-3">
                                    <button type="button" class="btn btn-light"><i class="icon-pencil7"></i> <span
                                            class="d-none d-lg-inline-block ml-2">Compose</span></button>
                                    <button type="button" class="btn btn-light"><i class="icon-bin"></i> <span
                                            class="d-none d-lg-inline-block ml-2">Delete</span></button>
                                    <button type="button" class="btn btn-light"><i class="icon-spam"></i> <span
                                            class="d-none d-lg-inline-block ml-2">Spam</span></button>
                                </div>
                            </div>

                            <div class="navbar-text ml-lg-auto"><span class="font-weight-semibold">1-50</span> of
                                <span class="font-weight-semibold">528</span>
                            </div>

                            <div class="ml-lg-3 mb-3 mb-lg-0">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light btn-icon disabled"><i
                                            class="icon-arrow-left12"></i></button>
                                    <button type="button" class="btn btn-light btn-icon"><i
                                            class="icon-arrow-right13"></i></button>
                                </div>

                                <div class="btn-group ml-3">
                                    <button type="button" class="btn btn-light dropdown-toggle"
                                        data-toggle="dropdown"><i class="icon-cog3"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                        <a href="#" class="dropdown-item">One more line</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /action toolbar -->


                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-inbox">
                            <tbody data-link="row" class="rowlink">
                                <tr class="unread">
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/brands/spotify.svg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Spotify</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">On Tower-hill, as you go down &nbsp;-&nbsp;
                                        </div>
                                        <span class="text-muted font-weight-normal">To the London docks, you may have
                                            seen a crippled beggar (or KEDGER, as the sailors say) holding a painted
                                            board before him, representing the tragic scene in which he lost his
                                            leg</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        11:09 pm
                                    </td>
                                </tr>

                                <tr class="unread">
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <span class="btn btn-warning rounded-circle btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </span>
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">James Alexander</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject"><span
                                                class="badge badge-success mr-2">Promo</span> There are three whales
                                            and three boats &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">And one of the boats (presumed to
                                            contain the missing leg in all its original integrity) is being crunched by
                                            the jaws of the foremost whale</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        10:21 pm
                                    </td>
                                </tr>

                                <tr class="unread">
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-full2 text-warning"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Nathan Jacobson</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">Any time these ten years, they tell me, has
                                            that man held up &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">That picture, and exhibited that
                                            stump to an incredulous world. But the time of his justification has now
                                            come. His three whales are as good whales as were ever published in Wapping,
                                            at any rate; and his stump</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        8:37 pm
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-full2 text-warning"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <span class="btn btn-indigo rounded-circle btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </span>
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Margo Baker</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">Throughout the Pacific, and also in Nantucket,
                                            and New Bedford &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">and Sag Harbor, you will come
                                            across lively sketches of whales and whaling-scenes, graven by the fishermen
                                            themselves on Sperm Whale-teeth, or ladies' busks wrought out of the Right
                                            Whale-bone</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        4:28 am
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/brands/dribbble.svg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Dribbble</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">The whalemen call the numerous little
                                            ingenious contrivances &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">They elaborately carve out of the
                                            rough material, in their hours of ocean leisure. Some of them have little
                                            boxes of dentistical-looking implements</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        Dec 5
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <span class="btn btn-indigo rounded-circle btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </span>
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Hanna Dorman</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">Some of them have little boxes of
                                            dentistical-looking implements &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">Specially intended for the
                                            skrimshandering business. But, in general, they toil with their jack-knives
                                            alone; and, with that almost omnipotent tool of the sailor</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        Dec 5
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/brands/twitter.svg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Twitter</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject"><span
                                                class="badge badge-indigo mr-2">Order</span> Long exile from
                                            Christendom &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">And civilization inevitably
                                            restores a man to that condition in which God placed him, i.e. what is
                                            called savagery</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        Dec 4
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-full2 text-warning"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <span class="btn btn-pink rounded-circle btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </span>
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Vanessa Aurelius</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">Your true whale-hunter is as much a savage as
                                            an Iroquois &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">I myself am a savage, owning no
                                            allegiance but to the King of the Cannibals; and ready at any moment to
                                            rebel against him. Now, one of the peculiar characteristics of the savage in
                                            his domestic hours</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        Dec 4
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">William Brenson</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">An ancient Hawaiian war-club or spear-paddle
                                            &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">In its full multiplicity and
                                            elaboration of carving, is as great a trophy of human perseverance as a
                                            Latin lexicon. For, with but a bit of broken sea-shell or a shark's
                                            tooth</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        Dec 4
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/brands/facebook.svg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Facebook</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">As with the Hawaiian savage, so with the white
                                            sailor-savage &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">With the same marvellous patience,
                                            and with the same single shark's tooth, of his one poor jack-knife, he will
                                            carve you a bit of bone sculpture, not quite as workmanlike</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        Dec 3
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-full2 text-warning"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Vicky Barna</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject"><span
                                                class="badge badge-pink mr-2">Track</span> Achilles's shield
                                            &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">Wooden whales, or whales cut in
                                            profile out of the small dark slabs of the noble South Sea war-wood, are
                                            frequently met with in the forecastles of American whalers. Some of them are
                                            done with much accuracy</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        Dec 2
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/brands/youtube.svg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Youtube</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">At some old gable-roofed country houses
                                            &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">You will see brass whales hung by
                                            the tail for knockers to the road-side door. When the porter is sleepy, the
                                            anvil-headed whale would be best. But these knocking whales are seldom
                                            remarkable as faithful essays</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        Nov 30
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Tony Gurrano</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">On the spires of some old-fashioned churches
                                            &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">You will see sheet-iron whales
                                            placed there for weather-cocks; but they are so elevated, and besides that
                                            are to all intents and purposes so labelled with "HANDS OFF!" you cannot
                                            examine them</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        Nov 28
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <span class="btn btn-danger rounded-circle btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </span>
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Barbara Walden</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">In bony, ribby regions of the earth
                                            &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">Where at the base of high broken
                                            cliffs masses of rock lie strewn in fantastic groupings upon the plain, you
                                            will often discover images as of the petrified forms</span>
                                    </td>
                                    <td class="table-inbox-attachment"></td>
                                    <td class="table-inbox-time">
                                        Nov 28
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label p-0"></span>
                                        </label>
                                    </td>
                                    <td class="table-inbox-star rowlink-skip">
                                        <a href="#">
                                            <i class="icon-star-full2 text-warning"></i>
                                        </a>
                                    </td>
                                    <td class="table-inbox-image">
                                        <img src="{{ asset('adminAssets/images/brands/amazon.svg') }}"
                                            class="rounded-circle" width="32" height="32" alt="">
                                    </td>
                                    <td class="table-inbox-name">
                                        <a href="mail_read.html">
                                            <div class="letter-icon-title text-body">Amazon</div>
                                        </a>
                                    </td>
                                    <td class="table-inbox-message">
                                        <div class="table-inbox-subject">Here and there from some lucky point of view
                                            &nbsp;-&nbsp;</div>
                                        <span class="text-muted font-weight-normal">You will catch passing glimpses of
                                            the profiles of whales defined along the undulating ridges. But you must be
                                            a thorough whaleman, to see these sights; and not only that, but if you wish
                                            to return to such a sight again</span>
                                    </td>
                                    <td class="table-inbox-attachment">
                                        <i class="icon-attachment text-muted"></i>
                                    </td>
                                    <td class="table-inbox-time">
                                        Nov 27
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /table -->

                </div>
                <!-- /my inbox -->

            </div>
        </div>
        <!-- /right content -->

    </div>
    <!-- /inner container -->

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".select-search").select2();
    });
</script>
