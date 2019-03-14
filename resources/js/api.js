import ky from 'ky'

export const api = ky.extend({
  prefixUrl: process.env.MIX_APP_URL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
  },
})
