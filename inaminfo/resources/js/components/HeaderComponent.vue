<template>
  <div id="header-nav" class="shadow-l2">
        <div class="header-nav__content" v-bind:class="{ 'active': status }" v-on:click="toggleMenuStatus">
            <div class="header-nav__list">
                <router-link to="/">
                    <div class="header-nav__item" v-bind:class="(this.$route.path === '/') ? 'active' : ''">
                        <i class="fas fa-home header-nav__item--icon"></i>
                        <div class="header-nav__item--text">HOME</div>
                    </div>
                </router-link>
                <router-link to="/events">
                    <div class="header-nav__item" v-bind:class="(this.$route.path === '/events') ? 'active' : ''">
                        <i class="fas fa-search header-nav__item--icon"></i>
                        <div class="header-nav__item--text">EVENTS</div>
                    </div>
                </router-link>
                <router-link to="/calendar">
                    <div class="header-nav__item" v-bind:class="(this.$route.path === '/calendar') ? 'active' : ''">
                        <i class="fas fa-calendar-alt header-nav__item--icon"></i>
                        <div class="header-nav__item--text">CALENDAR</div>
                    </div>
                </router-link>
                <router-link to="/tickets">
                    <div class="header-nav__item" v-bind:class="(this.$route.path === '/tickets') ? 'active' : ''">
                        <i class="fas fa-ticket-alt header-nav__item--icon"></i>
                        <div class="header-nav__item--text">TICKETS</div>
                    </div>
                </router-link>
            </div>  
            <div class="header-nav__search">
                <form @submit.prevent="searchEventLists">
                    <div class="header-nav__searchBox">
                        <input-suggest-component @change="wordUpdate" :searchWord="searchWord"/>
                        <input type="submit" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'header-nav',
  data: function(){
    return{
        status: false,
        searchWord:""
        }
  },
  methods: {
    toggleMenuStatus: function (event) {
        if(window.innerWidth <= 992){
            this.status = !this.status;
        }
    },
	wordUpdate(searchWord){
		this.searchWord = searchWord
	}
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
    #header-nav{
        height:56px;
        position: fixed;
        top:0;
        z-index:11;
        width:100%;
    }
    .header-nav__content{
        font-size:0.9rem;
        line-height:56px;
        margin:0 auto;
        z-index: 10;
    }
    .header-nav__search input[type="text"]{
        width: 100%;
        border-top: none;
        border-right: none;
        border-left: none;
        font-size: 16px;
        padding: 0.4em 0;
        border:none;
        border-radius: 4px;
        box-shadow:inset 0 1px 2px #ccc;
        opacity: 0.5;
    }
    .header-nav__search input[type="text"]:focus{
        opacity: 1.0;
        transition-duration: 0.3s;
    }
    .rnd-container{
        margin-top:12px;
        margin-bottom:12px;
        height:32px;

    }
    .rnd-input-container{
        height:32px;
    }
    .rnd-text{
        line-height: 32px;
    }
    .header-nav__searchBox input[type="submit"]{
        display: none;
    }
    @media screen and (min-width:1143px) { 
        .header-nav__search{
            margin-left: 200px;
            width: 250px;
        }
        .header-nav__content{
            display: flex;
            width:992px;
        }
        .header-nav__list{
            display:flex;
        }
        .header-nav__item{
            color:#fff;
            padding:0 20px;
        }
        .header-nav__item--icon{
            display: none;
        }
    }
    @media screen and (max-width:1142px) { 
        .header-nav__search{
            width: 80%;
            margin: 0 auto;
        }
        .header-nav__list{
            position: fixed;
            display: flex;
            bottom: 0;
            background-color: #fff;
            width: 100%;
            justify-content: space-between;
            border: 1px solid #ccc;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 -1px 3px 1px rgba(60, 64, 67, 0.15);
        }
        .header-nav__item{
            color:#FF5192;
            font-size:10px;
            margin:0 15px 0 10px;
            position: relative;
            height: 56px;
            width:56px;
            opacity: 0.5;
            &.active{
                opacity: 1.0;
            }
        }
        .header-nav__item--icon{
            display: block;
            font-size: 2rem;
            padding-top: 5px;
            text-align: center;
        }
        .header-nav__item--text{
            position: absolute;
            top: 1.8em;
            width:100%;
            text-align: center;
        }
    }

</style>