@extends('principal')
@section('contenido')


<template v-if="menu==0">
<example-component></example-component>
</template>

<template v-if="menu==1">
<gestormedicamentos-component></gestormedicamentos-component>
</template>

<template v-if="menu==2">
<login></login>
</template>

<template v-if="menu==3">
<h1>3</h1>
</template>

<template v-if="menu==4">
<h1>4</h1>
</template>

<template v-if="menu==5">
<h1>5</h1>
</template>

<template v-if="menu==6">
<h1>6</h1>
</template>

<template v-if="menu==7">
<h1>7</h1>
</template>

<template v-if="menu==8">
<h1>8</h1>
</template>

<template v-if="menu==9">
<h1>9</h1>
</template>

<template v-if="menu==10">
<h1>10</h1>
</template>


@endsection