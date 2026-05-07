@extends ('layouts.header')

@section('content')
<div class="mx-52">
  <div class="flex justify-between items-center my-10">
    <h1 class="text-left text-2xl font-bold text-gray-500">
      お問い合わせ一覧
    </h1>
    <div>
      <a href="/contact" class="bg-blue-500 text-white p-2 rounded m-4">
        新規作成
      </a>
    </div>
  </div>
  <div>
    <p class="text-red-400 text-right">※ステータスが対応中、対応済みの場合は削除ができません</p>
  </div>

  <table class="w-full border border-gray-300 border-collapse">
    <tr class="border border-gray-300 h-12 text-lg">
      <th>お問合せ日時</th>
      <th>件名</th>
      <th>ステータス</th>
      <th></th>
      <th></th>
    </tr>
    @foreach ($contacts as $contact)
      <tr class="text-center h-12">
        <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
        <td>{{ $contact->title }}</td>
        <td>{{ $contact->status }}</td>
        <td></td>
        <td>
          @if ($contact->status === "未対応")
            <form action="/contact/{{$contact->id}}" method="post">
            @method('DELETE')
            @csrf
              <button
                type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded">
                  削除
              </button>
            </form>
          @endif
        </td>
        <td>
          <a href="/contact/{{ $contact->id }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            詳細
          </a>
        </td>

      </tr>
    @endforeach
  </table>
</div>
@endsection