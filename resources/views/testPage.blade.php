<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Student & Parent Registration') }}
            </h2>
            <a href="#" class="bg-slate-700 text-white rounded-md px-3 py-2 text-sm hover:bg-slate-600">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4" x-data="{ step: 0 }">

                <!-- Tabs Navigation -->
                <div class="mb-4 border-b border-gray-200 flex space-x-4">
                    <button
                        :class="{'border-b-2 border-blue-500 text-blue-600 font-semibold': step === 0}"
                        @click="step = 0"
                        class="px-3 py-2 text-gray-600 hover:text-blue-600 transition">
                        Student Info
                    </button>
                    <button
                        :class="{'border-b-2 border-blue-500 text-blue-600 font-semibold': step === 1}"
                        @click="step = 1"
                        class="px-3 py-2 text-gray-600 hover:text-blue-600 transition">
                        Parent 1
                    </button>
                    <button
                        :class="{'border-b-2 border-blue-500 text-blue-600 font-semibold': step === 2}"
                        @click="step = 2"
                        class="px-3 py-2 text-gray-600 hover:text-blue-600 transition">
                        Parent 2
                    </button>
                </div>

                <!-- Form Sections -->
                <form action="#" method="POST">
                    @csrf

                    <!-- Student Info -->
                    <div x-show="step === 0" x-transition>
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Student Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div>
                                <label class="block text-gray-700">Full Name</label>
                                <input type="text" name="student_name" class="w-full p-2 border rounded" />
                            </div>
                            <div>
                                <label class="block text-gray-700">Date of Birth</label>
                                <input type="date" name="student_dob" class="w-full p-2 border rounded" />
                            </div>
                            <div>
                                <label class="block text-gray-700">Gender</label>
                                <select name="student_gender" class="w-full p-2 border rounded">
                                    <option value="">Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700">Address</label>
                                <textarea name="student_address" rows="3" class="w-full p-2 border rounded"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Parent 1 Info -->
                    <div x-show="step === 1" x-transition>
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Parent 1 Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div>
                                <label class="block text-gray-700">Full Name</label>
                                <input type="text" name="parent1_name" class="w-full p-2 border rounded" />
                            </div>
                            <div>
                                <label class="block text-gray-700">Phone Number</label>
                                <input type="tel" name="parent1_phone" class="w-full p-2 border rounded" />
                            </div>
                            <div>
                                <label class="block text-gray-700">Email</label>
                                <input type="email" name="parent1_email" class="w-full p-2 border rounded" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700">Address</label>
                                <textarea name="parent1_address" rows="3" class="w-full p-2 border rounded"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Parent 2 Info -->
                    <div x-show="step === 2" x-transition>
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Parent 2 Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div>
                                <label class="block text-gray-700">Full Name</label>
                                <input type="text" name="parent2_name" class="w-full p-2 border rounded" />
                            </div>
                            <div>
                                <label class="block text-gray-700">Phone Number</label>
                                <input type="tel" name="parent2_phone" class="w-full p-2 border rounded" />
                            </div>
                            <div>
                                <label class="block text-gray-700">Email</label>
                                <input type="email" name="parent2_email" class="w-full p-2 border rounded" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700">Address</label>
                                <textarea name="parent2_address" rows="3" class="w-full p-2 border rounded"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-6">
                        <button
                            type="button"
                            x-show="step > 0"
                            @click="step--"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow transition">
                            Previous
                        </button>

                        <button
                            type="button"
                            x-show="step < 2"
                            @click="step++"
                            class="ml-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded shadow transition">
                            Next
                        </button>

                        <button
                            type="submit"
                            x-show="step === 2"
                            class="ml-auto bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded shadow transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="//cdn.jsdelivr.net/npm/alpinejs" defer></script>
</x-app-layout>
