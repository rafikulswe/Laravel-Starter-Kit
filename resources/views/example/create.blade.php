<div class="content">
    <div class="card">
        <div class="collapse show">
            <div class="card-body">
                <form id="myform" class="from-prevent-multiple-submits" action="{{ route('provider.example.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    {{-- <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" maxlength="80"
                                        class="form-control maxlength-options" value=""
                                        placeholder="Enter The Title" required> --}}

                                    <x-forms.label>Title</x-forms.label>
                                    <x-forms.input type="text" name="title" maxlength="80"
                                        placeholder="Enter The Title"></x-forms.input>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="mb-3">
                                    <label for="details">Details</label>
                                    <textarea rows="1" cols="3" maxlength="225" name="description" class="form-control maxlength-textarea"
                                        placeholder="This textarea has a limit of 225 chars."></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $(".select-search").select2();

    });
</script>
