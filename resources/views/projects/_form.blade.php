
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Project Title
        </label>
        <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" value="{{ $project->title }}" type="text" placeholder="Project Title">
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
          Project Description
        </label>
        <textarea required class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" rows="13" name="description" id="description">{{ $project->description }}</textarea>
      </div>

      <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          {{ $button }}
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/projects">
          Cancel
        </a>
      </div>