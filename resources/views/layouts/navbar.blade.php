<style>
    #search-form {
        position: relative;
    }

    #search-input{
      padding-left: 40px
    }
    #search-icon {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 20px;
        height: 20px;
    }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/WSC2022SE_TP09_Logo_actual_en.png') }}"
                alt="Logo" height="24" class="d-inline-block align-text-top">
            </a>
        <form id="search-form" class="d-flex col-4" role="search">
            <input id="search-input" class="form-control me-2" type="text" placeholder="Search">
            <img id="search-icon" src="{{ asset('assets/icons/135-search.png') }}" alt="" srcset="">
        </form>
        <span>Welcome {{ $user->FullName }}</span>
    </div>
</nav>
