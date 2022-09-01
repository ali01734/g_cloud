<div class="modal fade" tabindex="-1" role="dialog" id="@yield('modal.id')">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- Close button --}}
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="modal-title text-blue">
                    <i class="fa @yield('modal.fa')"></i>
                    <strong> @yield('modal.title') </strong>
                </h4>
            </div>
            <form action="@yield('modal.form.url')"
                  method="@yield('modal.form.method')"
                  class="form">
                <div class="modal-body">
                    <div>
                        {!! csrf_field() !!}
                        @yield('modal.form.method-field', '')
                    </div>
                    @yield('modal.body')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{ trans('strings.cancel') }}
                        <i class="fa fa-ban"></i>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ trans('strings.add') }}
                        <i class="fa fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>