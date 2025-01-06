<!-- Footer -->
<footer id="footer">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-md-12">
            <div class="copyright text-center  text-lg-left  text-muted ">
                {{__('messages.all_rights_reserved')}} &copy; {{ date('Y') }} <a
                        href="{{$adminSettings['website']}}" class="font-weight-bold ml-1 footer-link-color"
                        target="_blank">{{ $adminSettings['company_name'] }}</a>
                <samp class="float-right ">{{getCurrentVersion()}}</samp>
            </div>
        </div>
    </div>
</footer>
