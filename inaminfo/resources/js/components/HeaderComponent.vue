<template>
    <div>
        <div class="header-nav shadow-l2">
            <div class="header-nav__content" v-bind:class="{ 'active': status }" v-on:click="toggleMenuStatus">
                <div class="header-nav__list contentPC">
                    <div class="header-nav__listInner">
                        <div class="header-nav__item" v-bind:class="(this.$route.path === '/') ? 'active' : ''" v-on:click="movePage('/')">
                            <i class="fas fa-home header-nav__item--icon"></i>
                            <div class="header-nav__item--text">HOME</div>
                        </div>
                        <div class="header-nav__item" v-bind:class="(this.$route.path.includes('/events')) ? 'active' : ''" v-on:click="movePage('/events')">
                            <i class="fas fa-search header-nav__item--icon"></i>
                            <div class="header-nav__item--text">EVENTS</div>
                        </div>
                        <div class="header-nav__item" v-bind:class="(this.$route.path.includes('/calendar')) ? 'active' : ''" v-on:click="movePage('/calendar')">
                            <i class="fas fa-calendar-alt header-nav__item--icon"></i>
                            <div class="header-nav__item--text">CALENDAR</div>
                        </div>
                        <div class="header-nav__item" v-bind:class="(this.$route.path.includes('/profile')) ? 'active' : ''" v-on:click="movePage('/profile')">
                            <i class="fas fa-user-circle header-nav__item--icon"></i>
                            <div class="header-nav__item--text">PROFILE</div>
                        </div>
                    </div>  
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
        <div class="header-nav__list contentSP">
            <div class="header-nav__listInner">
                <div class="header-nav__item" v-bind:class="(this.$route.path === '/') ? 'active' : ''" v-on:click="movePage('/')">
                    <i class="fas fa-home header-nav__item--icon"></i>
                    <div class="header-nav__item--text">HOME</div>
                </div>
                <div class="header-nav__item" v-bind:class="(this.$route.path.includes('/events')) ? 'active' : ''" v-on:click="movePage('/events')">
                    <i class="fas fa-search header-nav__item--icon"></i>
                    <div class="header-nav__item--text">EVENTS</div>
                </div>
                <div class="header-nav__item" v-bind:class="(this.$route.path.includes('/calendar')) ? 'active' : ''" v-on:click="movePage('/calendar')">
                    <i class="fas fa-calendar-alt header-nav__item--icon"></i>
                    <div class="header-nav__item--text">CALENDAR</div>
                </div>
                <div class="header-nav__item" v-bind:class="(this.$route.path.includes('/profile')) ? 'active' : ''" v-on:click="movePage('/profile')">
                    <i class="fas fa-user-circle header-nav__item--icon"></i>
                    <div class="header-nav__item--text">PROFILE</div>
                </div>
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
		this.searchWord = searchWord;
    },
    searchEventLists: function (event) {
		document.activeElement.blur();
        if(this.$route.path.includes('/search')){
            this.$router.replace({ path: '/search', query: { searchWord : this.searchWord } },() =>{});
        }else{
            this.$router.push({ path: '/search', query: { searchWord : this.searchWord } },() =>{});
        }
        this.searchWord = "";
    },
    movePage: function (link){
        this.$router.push({ path: link},() => {});
        this.searchWord = "";
    }
  }
}
</script>

<style lang="scss">
@import '../../sass/variables';
    .header-nav{
        height:56px;
        position: fixed;
        top:0;
        z-index:11;
        width:100%;
        background-color:$color-main;
        &__content{
            font-size:0.9rem;
            line-height:56px;
            margin:0 auto;
            z-index: 10;
        }
        &__search{
            input[type="text"]{
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
                margin :0;
                &:focus{
                    opacity: 1.0;
                    transition-duration: 0.3s;
                }
            }
            &Box{
                input[type="submit"]{
                    display: none;
                }
            }
        }
    }
    .rnd{
        &-container{
            margin-top:12px;
            margin-bottom:12px;
            height:32px;
        }
        &-input-container{
            height:32px;
        }
        &-text{
            line-height: 32px;
        }
    }
    @media screen and (max-width:$sp-width) { 
        .content{
            &PC{
                display:none;
            }
        }
        .header-nav{
            &__search{
                width: 80%;
                margin: 0 auto;
                max-width: $sp-max-width;
            }
            &__list{
                position: fixed;
                bottom: 0;
                background-color: #fff;
                width: 100%;
                justify-content: space-between;
                border: 1px solid #ccc;
                box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 -1px 3px 1px rgba(60, 64, 67, 0.15);
                -webkit-backface-visibility:hidden;
                backface-visibility:hidden;
                overflow:hidden;
                z-index:10;
                &Inner{
                    display: flex;
                    justify-content: space-between;
                    max-width: $sp-max-width;
                    margin: 0 auto;
                }
            }
            &__item{
                color:#FF5192;
                font-size:10px;
                margin:0 15px 0 10px;
                position: relative;
                height: 56px;
                width:56px;
                opacity: 0.5;
                cursor: pointer;
                &.active{
                    opacity: 1.0;
                }
                &--icon{
                    display: block;
                    font-size: 2rem;
                    padding-top: 5px;
                    text-align: center;
                }
                &--text{
                    padding-top:3px;
                    text-align: center;
                }
            }
        }
        a:hover{
            opacity:1.0;
        }
    }
    @media screen and (min-width:$pc-width) { 
        .content{
            &SP{
                display:none;
            }
        }
        .header-nav{
            &__search{
                margin-left: 200px;
                width: 250px;
            }
            &__content{
                display: flex;
                width:992px;
            }
            &__list{
                &Inner{
                    display: flex;
                    justify-content: space-between;
                }
            }
            &__item{
                color:#fff;
                padding:0 20px;
                cursor: pointer;
                &:hover{
                    opacity: 0.5;
                    transition-duration: 0.3s;
                }
                &--icon{
                display: none;
                }
            }
        }
    }

</style>