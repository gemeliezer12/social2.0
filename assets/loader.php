<div id="loading-section" style="height: calc(100vh - 54px); position: relative;">
    <style>
        .loader {
            border-top: 2px solid var(--primary-color1); /* Blue */
            border-left: 1px solid var(--primary-color1); /* Blue */
            border-bottom: 1px solid var(--primary-color1-trans1); /* Blue */
            border-right: 2px solid var(--primary-color1-trans1); /* Blue */
            border-radius: 200px;
            width: 26px;
            height: 26px;
            animation: spin .6s linear infinite;
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            margin-top: 10px;

            }

            @keyframes spin {
            0% { transform: rotate(0deg);
                border-top: 2px solid var(--primary-color1);}
            20% { transform: rotate(40deg);
                border-top: 3px solid var(--primary-color1);}
            50% { transform: rotate(130deg);
                border-top: 4px solid var(--primary-color1);}
            80% { transform: rotate(300deg);
                border-top: 3px solid var(--primary-color1);}
            100% { transform: rotate(360deg);
                border-top: 2px solid var(--primary-color1);}
            }
    </style>
    <div class="loader"></div>
</div>