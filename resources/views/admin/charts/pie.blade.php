@extends('admin.layouts.app')

@section('title' , 'Admin-Charts piegraph')

@section('content')
  <style>
    /* Center the pie chart */
    #piechart-container {
      margin: 0 auto;
      text-align: center;
    }
  </style>

  <div id="piechart-container">
    <canvas id="pieChart"></canvas>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('public/js/piechart.js') }}"></script>
  
@endsection