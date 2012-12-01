var Admin = {

    init: function(e){

        this.initActionButtons();
    },

    initActionButtons: function(){
        var self = this;

        $("#addProject").bind('click', function(e){
            self.removeProjectListSection();
            $("#middle-container").html( _.template(Templates.AddProject, {}) );

            $("#middle-container").find("#members").select2({tags:["red", "green", "blue"]});
            $("#middle-container").find(".datepicker").datepicker();
        });

        $("#project-list li a").bind('click', function(e){
            $("#middle-container").html( _.template(Templates.ProjectDetails, {}) );
            self.init();
        });

        $("#create-member").bind('click', function(e){
            self.removeProjectListSection();
            $("#middle-container").html( _.template(Templates.AddMember, {}) );
        });

        $("#view-member-list").bind('click', function(e){
            self.removeProjectListSection();
            $("#middle-container").html( _.template(Templates.ViewMemberList, {}) );
        });

        $("#assignMember").bind('click', function(e){
            $("#assign-member-form").show();
        });

        $("#cancel-assign-member").bind('click', function(e){
            $(e.target).parent().hide();
        });

        $("#assign-member").bind('click', function(e){
            var memberName = $("#assign-member-form").find('input[name="member_name"]').val();
            $("#member-list").append('<span style="text-align:center"><img src="http://placehold.it/80x80" alt="" style="margin:5px;"><br/>'+ memberName +'<a href="" class="delete-member">Delete</a></span>');
            $("#assign-member-form").hide().find('input[name="member_name"]').val('');
        });

        $(".show-proposal-details").bind('click', function(){
            self.removeProjectListSection();
            console.log('show details');
            $("#middle-container").html( _.template(Templates.EOIDetails, {}) );
        });

        $("#view-eoi-list").bind('click', function(){
            self.removeProjectListSection();
            $("#middle-container").html( _.template(Templates.ExpressionOfInterest, {}) );
            self.init();
        });



        //local gov
        $("#view-ngo-list").bind('click', function(){
            $("#middle-container").html( _.template(Templates.ListOfNgo, {}) );
            $("#right-container").html( _.template(Templates.NGOStatus, {}) );
            $("#bottom-container").hide()
            self.init();
        });

        $(".pending-ngo").bind('click', function(e){
            var title = $(e.target).find('.ngo_name').html();
            console.log('test', title);
            $("#middle-container").html( _.template(Templates.NGODetails, {'ngo_title': title}) );
            $("#right-container").html( _.template(Templates.NGOSummary, {}) );
        });

    },

    removeProjectListSection:function(){

        $("#project-list li").removeClass('active');
    }
};


